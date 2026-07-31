<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php';

$c1=new dbcon();

$sections=[
    'summer'   => 'Summer Packages',
    'festival' => 'Festival Offer',
    'ads'      => 'Advertisements'
];

$grouped=[];
foreach($sections as $key=>$label){
    $grouped[$key]=[];
}

$sql="select a.*,
      (select round(avg(rating),1) from ad_ratings where ad_id=a.id) as avg_rating,
      (select count(*) from ad_ratings where ad_id=a.id) as rating_count
      from ads a where a.status='active' order by a.id desc";
$r=$c1->conn->query($sql);

while($row=$r->fetch_assoc()){
    $cat=$row['category'] ?? 'ads';
    if(!isset($grouped[$cat])){
        $grouped[$cat]=[];
    }
    $grouped[$cat][]=$row;
}

// ---- Compute least-occupied buses for 20% OFF section ----
$occ_sql="select b.vehicle_no, b.company_name, b.route, b.bus_type, b.fare, b.noofseat,
    coalesce(sum(
        case when t.status='confirm'
        then (char_length(t.seat) - char_length(replace(t.seat, ',', '')) + 1)
        else 0 end
    ), 0) as booked_seats
    from bus b
    left join tickets t
        on t.veh_no = b.vehicle_no
        and t.travel_date >= curdate()
    group by b.vehicle_no, b.company_name, b.route, b.bus_type, b.fare, b.noofseat";
$occ_res=$c1->conn->query($occ_sql);

$buses=[];
while($row=$occ_res->fetch_assoc()){
    $row['occupancy_rate'] = $row['noofseat']>0 ? $row['booked_seats']/$row['noofseat'] : 1;
    $row['discounted_fare'] = round($row['fare']*0.8, 2);
    $buses[]=$row;
}

usort($buses, function($a,$b){
    return $a['occupancy_rate'] <=> $b['occupancy_rate'];
});

$discountBuses = array_slice($buses, 0, 4);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tours & Offers</title>
<script src="../javascript/jquery.js"></script>
<script src="../javascript/style.js"></script>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    background:#f4f7fb;
}

.navbar{
    width:100%;
    height:70px;
    background:#1e3c72;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:0 30px;
    color:white;
    box-shadow:0 2px 10px rgba(0,0,0,.3);
}

.navbar .logo{
    font-size:22px;
    font-weight:bold;
}

.navbar button{
    padding:10px 20px;
    border:none;
    border-radius:6px;
    background:white;
    color:#1e3c72;
    cursor:pointer;
    font-weight:bold;
}

.container{
    width:90%;
    margin:30px auto;
}

.section-title{
    margin:30px 0 15px;
    color:#1e3c72;
}

.cards{
    display:flex;
    flex-wrap:wrap;
    gap:20px;
}

.card{
    background:white;
    width:280px;
    border-radius:10px;
    overflow:hidden;
    box-shadow:0 3px 10px rgba(0,0,0,.15);
}

.card img{
    width:100%;
    height:160px;
    object-fit:cover;
}

.card-body{
    padding:15px;
}

.card-body h3{
    color:#1e3c72;
    margin-bottom:8px;
}

.card-body p{
    font-size:14px;
    color:#444;
    margin-bottom:10px;
}

.stars{
    font-size:22px;
    cursor:pointer;
    margin-bottom:8px;
}

.stars span{
    color:#ccc;
}

.stars span.filled{
    color:#f5b301;
}

.rating-info{
    font-size:13px;
    color:#666;
    margin-bottom:10px;
}

.book-btn{
    width:100%;
    padding:10px;
    border:none;
    border-radius:6px;
    background:#2a5298;
    color:white;
    font-weight:bold;
    cursor:pointer;
}

.book-btn:hover{
    background:#1e3c72;
}

.empty{
    color:#888;
    font-style:italic;
}
</style>
</head>
<body>

<div class="navbar">
<div class="logo">Tours & Offers</div>
<button onclick="window.location.href='user.php'">Back to Home</button>
</div>

<div class="container">

<h2 class="section-title">20% OFF</h2>

<div class="cards">
<?php if(count($discountBuses)===0): ?>
    <p class="empty">No buses available right now.</p>
<?php else: ?>
    <?php foreach($discountBuses as $i=>$bus): ?>
    <?php
        $routeParts = explode('-', $bus['route'], 2);
        $fromCity = trim($routeParts[0] ?? '');
        $toCity = trim($routeParts[1] ?? '');
        $occPercent = round($bus['occupancy_rate']*100);
        $formId = "discountForm".$i;
    ?>
    <div class="card">
        <img src="../images/background.jpg" style="object-fit:contain; background:#eef2f7;">
        <div class="card-body">
            <h3><?= htmlspecialchars($bus['company_name']) ?></h3>
            <p><?= htmlspecialchars($bus['route']) ?> &middot; <?= htmlspecialchars($bus['bus_type']) ?></p>
            <p>Only <?= $occPercent ?>% seats booked &mdash; grab it before it fills up!</p>
            <p>
                <span style="text-decoration:line-through; color:#999;">Rs. <?= number_format($bus['fare'],2) ?></span>
                &nbsp;
                <b style="color:#c0392b;">Rs. <?= number_format($bus['discounted_fare'],2) ?></b>
                &nbsp;<span style="color:#27ae60; font-size:12px;">(20% OFF)</span>
            </p>

            <form id="<?= $formId ?>" action="ticketbook.php" method="post" style="display:none;">
                <input type="hidden" name="from" value="<?= htmlspecialchars($fromCity) ?>">
                <input type="hidden" name="to" value="<?= htmlspecialchars($toCity) ?>">
                <input type="hidden" name="date" value="<?= date('Y-m-d') ?>">
            </form>

            <button class="book-btn" onclick="document.getElementById('<?= $formId ?>').submit();">Book Now</button>
        </div>
    </div>
    <?php endforeach; ?>
<?php endif; ?>
</div>

<?php foreach($sections as $key=>$label): ?>

<h2 class="section-title"><?= htmlspecialchars($label) ?></h2>

<div class="cards">
<?php if(count($grouped[$key])===0): ?>
    <p class="empty">No offers added yet.</p>
<?php else: ?>
    <?php foreach($grouped[$key] as $ad): ?>
    <div class="card">
        <?php if(!empty($ad['image'])): ?>
        <img src="../images/ads/<?= htmlspecialchars($ad['image']) ?>">
        <?php endif; ?>
        <div class="card-body">
            <h3><?= htmlspecialchars($ad['title']) ?></h3>
            <p><?= htmlspecialchars($ad['description']) ?></p>

            <div class="stars" data-ad-id="<?= $ad['id'] ?>">
                <span data-val="1">★</span>
                <span data-val="2">★</span>
                <span data-val="3">★</span>
                <span data-val="4">★</span>
                <span data-val="5">★</span>
            </div>
            <div class="rating-info" id="rating-info-<?= $ad['id'] ?>">
                <?= $ad['avg_rating'] ? $ad['avg_rating']." / 5 (".$ad['rating_count']." ratings)" : "Not rated yet" ?>
            </div>

            <button class="book-btn" style="margin-bottom:8px; background:#666;" onclick="window.open('<?= htmlspecialchars($ad['redirect_url']) ?>','_blank')">View Details</button>
            <button class="book-btn" onclick="bookAd(<?= $ad['id'] ?>)">Book Now</button>
            <div id="form<?= $ad['id'] ?>"></div>
        </div>
    </div>
    <?php endforeach; ?>
<?php endif; ?>
</div>

<?php endforeach; ?>

</div>

<script>
function bookAd(id){

    $.ajax({
        url: "ad_form.php",
        type: "POST",
        data: {
            ad_id: id
        },
        success: function(data){

            // Display the form below the buttons
            $("#form" + id).html(data);

            // Set the hidden ad_id
            $("#form" + id + " #ad_id").val(id);

            // Remove any previous submit handlers
            $("#form" + id + " #bookingForm").off("submit").on("submit", function(e){

                e.preventDefault();

                $.ajax({

                    url: "book_ad.php",

                    type: "POST",

                    data: $(this).serialize(),

                    dataType: "json",

                    success: function(res){

                        if(res.status == "done"){

                            alert("Booking Successful");

                            $("#package" + id).fadeOut(500, function(){
                                $(this).remove();
                            });

                        }
                        else if(res.status == "duplicate"){

                            alert("You have already booked this package.");

                        }
                        else if(res.status == "login_required"){

                            alert("Please login first.");

                        }
                        else{

                            alert("Booking failed.");

                        }

                    },

                    error: function(){

                        alert("Server error.");

                    }

                });

            });

        },

        error: function(){

            alert("Form couldn't be opened.");

        }

    });

}

$(document).ready(function(){
    $(".stars").on("click","span",function(){
        let val=$(this).data("val");
        let adId=$(this).parent().data("ad-id");

        $(this).parent().children().each(function(){
            $(this).toggleClass("filled", $(this).data("val")<=val);
        });

        $.ajax({
            url:"rate_ad.php",
            type:"POST",
            data:{ ad_id: adId, rating: val },
            dataType:"json",
            success:function(data){
                if(data.status==="done"){
                    $("#rating-info-"+adId).text(data.avg_rating+" / 5 ("+data.total+" ratings)");
                }else{
                    alert("Could not save rating.");
                }
            },
            error:function(){
                alert("Error saving rating.");
            }
        });
    });
});
</script>

</body>
</html>

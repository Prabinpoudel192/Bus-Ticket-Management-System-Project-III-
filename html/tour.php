<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php';

$c1=new dbcon();

$sections=[
    'discount' => '20% OFF',
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tours & Offers</title>
<script src="../javascript/jquery.js"></script>

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

            <button class="book-btn" onclick="window.open('<?= htmlspecialchars($ad['redirect_url']) ?>','_blank')">Book Now</button>
        </div>
    </div>
    <?php endforeach; ?>
<?php endif; ?>
</div>

<?php endforeach; ?>

</div>

<script>
$(document).ready(function(){
    $(".stars span").hover(function(){
        let val=$(this).data("val");
        $(this).parent().children().each(function(){
            $(this).toggleClass("filled", $(this).data("val")<=val);
        });
    });

    $(".stars").on("click","span",function(){
        let val=$(this).data("val");
        let adId=$(this).parent().data("ad-id");

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
<?php
  session_start();
  $id=$_SESSION['u_id'];
  $uname=$_SESSION['u_name'];
  $mobile=$_SESSION['u_mobile'];

  include 'db.php';
  $c1=new dbcon();
  $m=3; 

  $c_sql="select avg(rating) as site_avg from ad_ratings";
  $c_res=$c1->conn->query($c_sql);
  $c_row=$c_res->fetch_assoc();
  $C=$c_row['site_avg'] ? $c_row['site_avg'] : 0;
//This part is for the star rating of the advertisement displayed by using the highest average rating among the tour packages
 $stmt = $c1->conn->prepare("
SELECT a.*,
       (SELECT AVG(rating)
        FROM ad_ratings
        WHERE ad_id = a.id) AS R,

       (SELECT COUNT(*)
        FROM ad_ratings
        WHERE ad_id = a.id) AS v

FROM ads a

WHERE a.status='active'
AND a.id NOT IN (
    SELECT ad_id
    FROM ad_bookings
    WHERE user_id = ?
      AND status IN ('pending','confirm')
)
");

$stmt->bind_param("i", $id);
$stmt->execute();
$top_res = $stmt->get_result();

  $top_ads=[];
  while($row=$top_res->fetch_assoc()){
      $v=$row['v'];
      $R=$row['R'];
      if($v>0){
          $row['wr']=(($v/($v+$m))*$R)+(($m/($v+$m))*$C);
      }else{
          $row['wr']=0;
      }
      $top_ads[]=$row;
  }

  usort($top_ads, function($a,$b){
      return $b['wr'] <=> $a['wr'];
  });
  $popularRoutes = [];
$q = $c1->conn->query("SELECT route, COUNT(*) AS total 
                        FROM tickets 
                        GROUP BY route 
                        ORDER BY total DESC 
                        LIMIT 4");
if($q){
    while($row = $q->fetch_assoc()){
        $popularRoutes[] = $row;
    }
}

  $top_ads=array_slice($top_ads,0,3);

  // ---- Stats section data ----
  $busCount = 0;
  $q = $c1->conn->query("SELECT COUNT(*) AS total FROM bus");
  if($q && $row = $q->fetch_assoc()){
      $busCount = $row['total'];
  }

  $customerCount = 0;
  $q = $c1->conn->query("SELECT COUNT(*) AS total FROM login where acc='2' and status='active'");
  if($q && $row = $q->fetch_assoc()){
      $customerCount = $row['total'];
  }

  $tourCount = 0;
  $q = $c1->conn->query("SELECT COUNT(*) AS total FROM ads WHERE status='active'");
  if($q && $row = $q->fetch_assoc()){
      $tourCount = $row['total'];
  }

  $satisfaction = 0;
  $q = $c1->conn->query("SELECT AVG(rating) AS avg_rating FROM ad_ratings");
  if($q && $row = $q->fetch_assoc() && $row['avg_rating'] > 0){
      $satisfaction = round(($row['avg_rating'] / 5) * 100);
  }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/user.css">
 <script src="../javascript/jquery.js"></script>
  <script src="../javascript/style.js"></script>
<title>Bus Ticket Management System</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Segoe UI',sans-serif;
}

html{
scroll-behavior:smooth;
}

body{
background:#f4f7fb;
overflow-x:hidden;
}
@media print {

    header,
    footer,
    .stats,
    .hidden,
    .bus {
        display: none !important;
    }

    body {
        margin: 0;
        padding: 0;
        background: white;
    }

    .hero {
        display: block;
        margin: 0;
        padding: 0;
    }

    .hero-content {
        width: 100%;
        margin: 0;
        padding: 0;
    }
}

</style>
</head>
<body>

<header>
<div class="logo"><img src="../images/logobusticket.png">Ticket And Destination Booking</div>

<nav>
<a href="user.php">Home</a>
<a href="#" id="showTickets">My Tickets</a>
<a href="tour.php">Tours</a>
<a href="profile.php">Profile</a>
<a href="index.php">Logout</a>
</nav>
</header>

<section class="hero">

<div class="hero-content">

<h1>Explore Nepal With Comfort</h1>

<p>Book buses, discover tours, and travel smarter.</p>

<div class="search-box">
<form action="ticketbook.php" method="POST" id="search-form">
<input type="text" name="from" placeholder="From" required>
<input type="text" name="to" placeholder="To" required>
<input type="date" name="date" min="<?= date('Y-m-d') ?>" required>
<button type="submit" class="btn-search">Search Buses</button>
</form>
</div>

</div>

<!--<div class="bus"><img src="../images/ad1.webp"></div>-->

</section>

<section class="hidden">

<h2 class="section-title">🔥 Special Offers</h2>

<div class="ads">

<div class="ad-card">
<h3>20% OFF</h3>
<p>Kathmandu → Pokhara</p>
</div>

<div class="ad-card">
<h3>Summer Package</h3>
<p>Visit Mustang this season.</p>
</div>

<div class="ad-card">
<h3>Festival Offer</h3>
<p>Travel and save more.</p>
</div>

</div>

</section>

<section class="hidden">

<h2 class="section-title">🚌 Popular Routes</h2>

<div class="routes">

<?php if(count($popularRoutes)===0): ?>
<p>No routes booked yet.</p>
<?php else: ?>
<?php foreach($popularRoutes as $r): ?>
<div class="route-card"><?= htmlspecialchars($r['route']) ?></div>
<?php endforeach; ?>
<?php endif; ?>

</div>

</section>

<section class="hidden">

<h2 class="section-title">⭐ Recommended Packages</h2>

<div class="packages">

<?php if(count($top_ads)===0): ?>
<p>No recommended packages yet.</p>
<?php else: ?>
<?php foreach($top_ads as $ad): ?>
<div class="package">
<img src="<?= !empty($ad['image']) ? '../images/ads/'.htmlspecialchars($ad['image']) : '../images/ad1.webp' ?>">
<div class="package-content">
    <h3><?= htmlspecialchars($ad['title']) ?></h3>
    <p>⭐ <?= $ad['v']>0 ? round($ad['R'],1) : 'Not rated yet' ?></p>

    <button onclick="window.open('<?= htmlspecialchars($ad['redirect_url']) ?>','_blank')">
        View Details
    </button>

    <button onclick="bookAd(<?= $ad['id'] ?>)">
        Book Now
    </button>

    <div id="form<?= $ad['id'] ?>"></div>
</div>
</div>
<?php endforeach; ?>
<?php endif; ?>

</div>

</section>

<div class="stats">

<div class="stat">
<h2 class="counter" data-target="<?= $busCount ?>">0</h2>
<p>Buses</p>
</div>

<div class="stat">
<h2 class="counter" data-target="<?= $customerCount ?>">0</h2>
<p>Customers</p>
</div>

<div class="stat">
<h2 class="counter" data-target="<?= $tourCount ?>">0</h2>
<p>Tours</p>
</div>

<div class="stat">
<h2 class="counter" data-target="<?= $satisfaction ?>">0</h2>
<p>% Satisfaction</p>
</div>

</div>

<section class="hidden">

<h2 class="section-title">Why Choose Us?</h2>

<div class="features">

<div class="feature">
<h3>🎫 Instant Booking</h3>
<p>Book seats in seconds.</p>
</div>

<div class="feature">
<h3>🛡 Secure Platform</h3>
<p>Your data stays protected.</p>
</div>

<div class="feature">
<h3>⭐ Top Rated Tours</h3>
<p>Based on customer reviews.</p>
</div>

<div class="feature">
<h3>📍 Travel Anywhere</h3>
<p>Across Nepal.</p>
</div>

</div>

</section>

<footer>

<h2>TravelNepal</h2>

<p>Bus Booking & Tour Recommendation Platform</p>

</footer>

<script>

const observer=new IntersectionObserver(entries=>{
entries.forEach(entry=>{
if(entry.isIntersecting){
entry.target.classList.add('show');
}
});
});

document.querySelectorAll('.hidden').forEach(el=>{
observer.observe(el);
});

const counters=document.querySelectorAll('.counter');

counters.forEach(counter=>{

const update=()=>{

const target=+counter.getAttribute('data-target');

const count=+counter.innerText;

const inc=target/100;

if(count<target){

counter.innerText=Math.ceil(count+inc);

setTimeout(update,20);

}else{

counter.innerText=target;

}

};

update();

});
$(document).ready(function(){
$("#showTickets").on("click", function(e) {
 $.ajax({
            url: "myTickets.php",
            type: "POST",
             data: {
             uname: <?= json_encode($uname) ?>,
             mobile:<?= json_encode($mobile) ?>
        },
            success: function(data){
               $(".hero-content").html(data);
            },
            error: function(){
                $(".hero-content").html("Error loading data");
            }
        });
    
      });
});
function printTicket(id) {
    const ticketHTML = document.getElementById('ticket-' + id).outerHTML;

    let printFrame = document.getElementById('print-frame');
    if (!printFrame) {
        printFrame = document.createElement('iframe');
        printFrame.id = 'print-frame';
        printFrame.style.position = 'fixed';
        printFrame.style.right = '0';
        printFrame.style.bottom = '0';
        printFrame.style.width = '0';
        printFrame.style.height = '0';
        printFrame.style.border = '0';
        document.body.appendChild(printFrame);
    }

    const doc = printFrame.contentWindow.document;
    doc.open();
    doc.write('<html><head><title>Ticket</title></head><body>' + ticketHTML + '</body></html>');
    doc.close();

    printFrame.contentWindow.focus();
    printFrame.contentWindow.print();
}

</script>

</body>
</html>
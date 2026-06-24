<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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

/* ================= NAVBAR ================= */

header{
position:fixed;
top:0;
width:100%;
padding:15px 8%;
display:flex;
justify-content:space-between;
align-items:center;
background:rgba(0,0,0,.4);
backdrop-filter:blur(10px);
z-index:999;
}

.logo{
    display: flex;
    align-items: center;   
    gap: 10px;       
    font-size: 24px;
    font-weight: bold;
    color:#F59E0B;
}

.logo img{
    width: 50px;           
    height: 50px;
    border-radius:15px;
    object-fit: contain;
    display: block;
}

nav a{
color:white;
text-decoration:none;
margin-left:25px;
font-weight:600;
transition:.3s;
}

nav a:hover{
color:#f59e0b;
}

/* ================= HERO ================= */

.hero{
height:100vh;
background:
linear-gradient(rgba(0,0,0,.45),
rgba(0,0,0,.45)),
url("../images/logo.png");
background-size:cover;
background-position:center;
display:flex;
align-items:center;
justify-content:center;
text-align:center;
position:relative;
overflow:hidden;
}

.hero-content{
color:white;
}

.hero-content h1{
font-size:60px;
margin-bottom:20px;
}

.hero-content p{
font-size:22px;
margin-bottom:30px;
}

.search-box{
background:rgba(255,255,255,.2);
backdrop-filter:blur(10px);
padding:25px;
border-radius:20px;
display:flex;
gap:10px;
justify-content:center;
flex-wrap:wrap;
}

.search-box input{
padding:12px;
border:none;
border-radius:10px;
width:220px;
}

.search-box button{
padding:12px 25px;
border:none;
background:#f59e0b;
color:white;
border-radius:10px;
cursor:pointer;
font-weight:bold;
}

/* ================= ANIMATED BUS ================= */

.bus{
border-radius:15px;
position:absolute;
bottom:30px;
left:-350px;
font-size:80px;
animation:busMove 12s linear infinite;
}
.bus img{
    height:200px;
    width:200px;
}

@keyframes busMove{
0%{
left:-350px;
}
100%{
left:120%;
}
}

/* ================= SECTION ================= */

section{
padding:80px 10%;
}

.section-title{
text-align:center;
font-size:40px;
margin-bottom:50px;
color:#1e293b;
}

/* ================= ADS ================= */

.ads{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
gap:20px;
}

.ad-card{
background:white;
padding:30px;
border-radius:20px;
box-shadow:0 10px 30px rgba(0,0,0,.1);
transition:.4s;
cursor:pointer;
}

.ad-card:hover{
transform:translateY(-10px);
}

.ad-card h3{
margin-bottom:10px;
}

/* ================= ROUTES ================= */

.routes{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
gap:20px;
}

.route-card{
background:#2563eb;
color:white;
padding:25px;
border-radius:15px;
font-size:18px;
font-weight:bold;
text-align:center;
transition:.3s;
cursor:pointer;
}

.route-card:hover{
transform:scale(1.05);
}

/* ================= PACKAGES ================= */

.packages{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
gap:25px;
}

.package{
background:white;
border-radius:20px;
overflow:hidden;
box-shadow:0 10px 25px rgba(0,0,0,.1);
transition:.4s;
}

.package:hover{
transform:translateY(-10px);
}

.package img{
width:100%;
height:220px;
object-fit:cover;
}

.package-content{
padding:20px;
}

.package-content h3{
margin-bottom:10px;
}

.package-content button{
margin-top:10px;
padding:10px 20px;
border:none;
background:#2563eb;
color:white;
border-radius:10px;
cursor:pointer;
}

/* ================= FEATURES ================= */

.features{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
gap:25px;
}

.feature{
background:white;
padding:30px;
border-radius:15px;
text-align:center;
box-shadow:0 10px 25px rgba(0,0,0,.08);
}

/* ================= COUNTER ================= */

.stats{
background:#1e293b;
color:white;
display:flex;
justify-content:space-around;
flex-wrap:wrap;
padding:60px 20px;
}

.stat{
text-align:center;
margin:20px;
}

.stat h2{
font-size:50px;
}

/* ================= FOOTER ================= */

footer{
background:#111827;
color:white;
padding:50px;
text-align:center;
}

/* ================= ANIMATION ================= */

.hidden{
opacity:0;
transform:translateY(50px);
transition:1s;
}

.show{
opacity:1;
transform:translateY(0);
}

</style>
</head>
<body>

<header>
<div class="logo"><img src="../images/logobusticket.png">Ticket And Destination Booking</div>

<nav>
<a href="#">Home</a>
<a href="#">Book Ticket</a>
<a href="#">My Tickets</a>
<a href="#">Tours</a>
<a href="#">Profile</a>
<a href="#">Logout</a>
</nav>
</header>

<section class="hero">

<div class="hero-content">

<h1>Explore Nepal With Comfort</h1>

<p>Book buses, discover tours, and travel smarter.</p>

<div class="search-box">
<input type="text" placeholder="From">
<input type="text" placeholder="To">
<input type="date">
<button>Search Bus</button>
</div>

</div>

<div class="bus"><img src="../images/ad1.webp"></div>

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

<div class="route-card">Kathmandu → Pokhara</div>
<div class="route-card">Kathmandu → Chitwan</div>
<div class="route-card">Pokhara → Butwal</div>
<div class="route-card">Kathmandu → Nepalgunj</div>

</div>

</section>

<section class="hidden">

<h2 class="section-title">⭐ Recommended Packages</h2>

<div class="packages">

<div class="package">
<img src="../imges/ad1.webp">
<div class="package-content">
<h3>Mustang Tour</h3>
<p>⭐ 4.9 Rating</p>
<button>View Details</button>
</div>
</div>

<div class="package">
<img src="../imges/ad2.webp">
<div class="package-content">
<h3>Pokhara Retreat</h3>
<p>⭐ 4.8 Rating</p>
<button>View Details</button>
</div>
</div>

<div class="package">
<img src="../images/ad3.webp">
<div class="package-content">
<h3>Chitwan Safari</h3>
<p>⭐ 4.7 Rating</p>
<button>View Details</button>
</div>
</div>

</div>

</section>

<div class="stats">

<div class="stat">
<h2 class="counter" data-target="1200">0</h2>
<p>Buses</p>
</div>

<div class="stat">
<h2 class="counter" data-target="25000">0</h2>
<p>Customers</p>
</div>

<div class="stat">
<h2 class="counter" data-target="150">0</h2>
<p>Tours</p>
</div>

<div class="stat">
<h2 class="counter" data-target="99">0</h2>
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

</script>

</body>
</html>
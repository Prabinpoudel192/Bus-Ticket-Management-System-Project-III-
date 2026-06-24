<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/user.css">
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
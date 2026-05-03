  <?php
  session_start();
  $id=$_SESSION['u_id'];
  $uname=$_SESSION['u_name'];
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Bus Ticket System</title>
<link rel="stylesheet" href="../css/index.css">
<link rel="stylesheet" href="../bootstrap-5.3.4-dist/css/bootstrap.min.css">
<script src="../javascript/jquery.js"></script>
<script src="../javascript/style.js"></script>
<style>
* {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color:black;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            overflow: scroll;
            position: relative;
            z-index:0;
        }

         body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image:url("../images/background.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0.2;
            z-index: -1;
        } 
.page {
  display: none;
  padding: 20px;
}

.active {
  display: block;
}
.selected{
  background-color:yellow;
  color:red;
}
.booked{
  background-color:red;
  color:black;
  font-weight:900;
}
table {
  border: 2px solid black;
  border-collapse: collapse;
  width:400px;
}
td, th {
  border: 2px solid black;
  padding: 10px;
  text-align: center;
}
.search-card{
  margin:100px 0px 100px 600px;
}


</style>

</head>
<body>
 <script>
$(document).ready(function(){
  let date="";
  let time="";
  let route="";
$("#search-form").on("submit", function(e) {
    e.preventDefault();
    let from = $("input[name='from']").val();
    let to = $("input[name='to']").val();
      date = $("input[name='date']").val();
      time = $("input[name='time']").val();
      route=from+" to "+to;

    bookfunc(route,date,time);
});
$("#confirm").on("click", function(e) {
    e.preventDefault();
    document.querySelector("#passenger").style.display="none";
    generateTicket(route,date,time,<?=json_encode($id)?>,<?=json_encode($uname)?>);

});
});

 </script>
  <div class="display">
  <div class="search-card">
      <h1>Find Your Bus Ticket</h1>
<form action="" method="post" id="search-form">
      <div class="inputs">
        <input type="text" placeholder="From (City)" name="from">
        <input type="text" placeholder="To (City)" name="to">
        <input type="date" name="date">
        <input type="time" name="time">
        <button type="submit" class="btn-search">Search Buses</button>
      </div></form>
</div></div>
<div id="booking" class="page">
  <h2>Select Seats</h2>

  <div class="bus" id="bus"></div>

  <button onclick="goToPassenger()">Continue</button>
</div>
<div id="passenger" class="page">
  <button type="submit" id="confirm" >Confirm Booking</button>
</form>
</div>
<div id="ticket" class="page">
  <h2>🎟️ Your Ticket</h2>

  <p id="ticketDetails"></p>

  <button onclick="window.print()">🖨️ Print</button>
  <button onclick="resetApp()">🔄 New Booking</button>
</div>

</body>
</html>
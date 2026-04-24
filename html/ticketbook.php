<?php


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Bus Ticket System</title>
<link rel="stylesheet" href="../css/style.css">
<style>
body {
  font-family: Arial, sans-serif;
  margin: 0;
  background: #f4f4f4;
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
  height:50px;
  width: 100px;
  border-collapse: collapse;
}
td, th {
  border: 2px solid black;
  padding: 10px;
  text-align: center;
}

</style>

</head>
<body>
<div id="home" class="page active">
  <h1>🚌 Bus Ticket System</h1>
  <button onclick="showPage('booking')">🎟️ Book Ticket</button>
</div>
<div id="booking" class="page">
  <h2>Select Seats</h2>

  <div class="bus" id="bus"></div>

  <button onclick="goToPassenger()">Continue</button>
</div>
<div id="passenger" class="page">
  <h2>Passenger Details</h2>

  <input type="text" id="name" placeholder="Name">
  <input type="number" id="age" placeholder="Age">

  <button onclick="generateTicket()">Confirm Booking</button>
</div>
<div id="ticket" class="page">
  <h2>🎟️ Your Ticket</h2>

  <p id="ticketDetails"></p>

  <button onclick="window.print()">🖨️ Print</button>
  <button onclick="resetApp()">🔄 New Booking</button>
</div>
<script defer src="../javascript/style.js"></script>
</body>
</html>
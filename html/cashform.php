<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('Asia/Kathmandu');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Cash Booking - Bus Ticket Booking System</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/index.css">
</head>
<body>

<!-- NAVBAR -->
<div class="navbar1">
    <h2>🚍 Cash Booking</h2>
    <div class="nav-buttons">
        <button class="btn4" onclick="window.location.href='staffTicket.php'">Back</button>
    </div>
</div>

<!-- SIDEBAR -->
<div class="sidebar1">
    <button class="btn6">Add Ticket (Cash)</button>
</div>

<!-- MAIN CONTENT -->
<div class="main container">

    <h2>Add Ticket - Cash Payment</h2>

    <div class="table-box" style="width:35%;">
    <form action="ticket_insert.php" method="post">

        <div class="form-group">
            <label>Passenger Name</label>
            <input type="text" name="name" placeholder="Full Name" required>
        </div>

        <div class="form-group">
            <label>Address</label>
            <input type="text" name="address" placeholder="Address" required>
        </div>

        <div class="form-group">
            <label>Mobile</label>
            <input type="text" name="mobile" placeholder="Mobile Number" required>
        </div>

        <div class="form-group">
            <label>Company Name</label>
            <input type="text" name="company_name" placeholder="Company Name" required>
        </div>

        <div class="form-group" style="display:flex; align-items:center; gap:10px;">
        <label style="white-space:nowrap;">Route</label>
        <div style="display:flex; gap:5px; flex:1;">
          <input type="text" name="from" placeholder="From" required style="width:50%;">
          <input type="text" name="to" placeholder="To" required style="width:50%;">
        </div>
        </div>

        <div class="form-group">
            <label>Seat</label>
            <input type="text" name="seat" placeholder="Seat No(s)." required>
        </div>

        <div class="form-group">
            <label>Travel Date</label>
            <input type="date" name="date" value="<?= date('Y-m-d') ?>" readonly>
        </div>

        <div class="form-group">
            <label>Travel Time</label>
            <input type="text" name="travel_time" value="<?= date('h:i A') ?>" readonly>
        </div>

        <div class="form-group">
            <label>Vehicle No</label>
            <input type="text" name="veh_no" placeholder="Vehicle No." required>
        </div>

        <div class="form-group">
            <label>Fare</label>
            <input type="number" step="0.01" name="fare" placeholder="Fare" required>
        </div>
        <div class="form-group">
            <button type="submit" class="submit-btn">Add Ticket</button>
        </div>

    </form>
    </div>

</div>

</body>
</html>
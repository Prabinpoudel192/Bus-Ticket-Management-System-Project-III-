<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
$id=$_SESSION['u_id'];
$uname=$_SESSION['u_name'];
$mobile=$_SESSION['u_mobile'];
include 'db.php';

$conn = new dbcon();
$conn = $conn->conn;

$sql="select assigned_veh from staff where username='$uname' and contact='$mobile'"; 
$result = $conn->query($sql);
$row = $result ? $result->fetch_assoc() : null;
$veh_no = $row['assigned_veh'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Staff Panel - Bus Ticket Booking System</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/index.css">
<script src="../javascript/jquery.js"></script>
<script src="../javascript/staff.js"></script>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background: linear-gradient(135deg, #1e3c72, #2a5298);
    color: black;
    overflow-x: hidden;
    overflow-y: auto;
}
.page{
    display:none;
}

.page.active{
    display:block;
}

.display{
    margin-bottom:20px;
    width:90%;
}
</style>
 <script>
$(document).ready(function(){
    
    
    $(".btn1").click(function(){
        window.location.href="staffTicket.php";
    });
    $(".btn2").click(function(){
    $("#booking").addClass("active");
    $.ajax({
        url:"staffbooked.php",
        type: "POST",
        data: { veh: <?=json_encode($veh_no)?> },
        success: function(data){
           $(".display").html(data);
        },
        error: function(){
            $(".display").html("Error loading data");
        }
    });
});
$(document).on("click", ".button", function(){
    let id = $(this).data("id");

    if(!confirm("Are you sure you want to delete this booking?")) return;

    $.ajax({
        url: "release_seat.php",
        type: "POST",
        data: { id: id },
        success: function(data){
            $(".display").html(data);
        },
        error: function(){
            $(".display").html("Error loading data");
        }
    });
});

});
   

 </script>
</head>

<body>
<!-- NAVBAR -->
<div class="navbar1">
    <h2>🚍 Staff Panel</h2>

    <div class="nav-buttons">
        <button class="btn4" onclick="window.location.href='index.php'">Logout</button>
    </div>
</div>

<!-- SIDEBAR -->
<div class="sidebar1">
    <button class="btn1">Available Seats</button>
    <button class="btn2">Free Seats</button>
    <button class="btn7">My Bookings</button>
</div>

<!-- MAIN CONTENT -->
<div class="main container">

    <h2>Book Seat - Cash Payment</h2>

    <!-- Hidden pages -->
    <div id="booking" class="page">

        <div class="display"></div>

        <div id="bus"></div>

    </div>

</div>

</body>
</html>
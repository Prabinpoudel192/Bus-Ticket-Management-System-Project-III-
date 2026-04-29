<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);
include 'db.php';
include 'registerbus.php';
if(isset($_POST['post3'])){
    $company_name=$_POST['company_name'];
    $owner_name=$_POST['owner_name'];
    $engine_no=$_POST['engine_no'];
    $chassis_no=$_POST['chassis_no'];
    $vehicle_no=$_POST['vehicle_no'];
    $seats=$_POST['seats'];
    $bus_type=$_POST['bus_type'];
    $start=$_POST['from_location'];
    $end=$_POST['to_location'];
    $fare=$_POST['fare'];
    $arr_time=$_POST['arr_time'];
    $dep_time=$_POST['dep_time'];
    $route=$start." to ".$end;
        $c1=new dbcon();
        $c2=new registerbus($company_name,$owner_name,$engine_no,$chassis_no,$vehicle_no,$seats,$bus_type,$route,$fare,$arr_time,$dep_time);
        $r=$c2->insert($c1->conn);
         if($r=="error"){
            echo "<script>alert('Error in registration.')</script>";
            die();
            }
         if($r=="done"){
            echo "<script>alert('Bus registration is successful!')</script>";
         }
         }
else if(isset($_POST['post1'])){
    $uname=$_POST['uname'];
    $pwd=$_POST['pwd'];
    header("Location:ticketbook.php");
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard - Bus Ticket Booking System</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/index.css">
<script src="../javascript/jquery.js"></script>

<style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background: linear-gradient(135deg, #1e3c72, #2a5298);
    color:black;
    overflow-x: hidden;
}
</style>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar1">
    <h2>🚍 Admin Panel</h2>
    <div class="nav-buttons">
        <button class="btn1" onclick="adminfunc()">Dashboard</button>
        <button class="btn2" onclick="adminfunc()">Active Users</button>
        <button class="btn3" onclick="adminfunc()">Buses</button>
        <button class="btn4" onclick="window.location.href='index.php'">Logout</button>
    </div>
</div>

<!-- SIDEBAR -->
<div class="sidebar1">
    <button class="btn5">Home</button>
    <button class="btn6" onclick="adminfunc()">Add Bus</button>
    <button class="btn7">Bookings</button>
    <button class="btn8">Payments</button>
    <button class="btn9" onclick="adminfunc()">User Registration</button>
</div>

<!-- MAIN CONTENT -->
<div class="main container">

    <h2>Dashboard Overview</h2>

    <!-- CARDS -->
    <div class="cards">
        <div class="card">
            <h3>Total Users</h3>
            <p>120</p>
        </div>

        <div class="card">
            <h3>Total Buses</h3>
            <p>35</p>
        </div>

        <div class="card">
            <h3>Bookings</h3>
            <p>240</p>
        </div>

        <div class="card">
            <h3>Revenue</h3>
            <p>₹ 50,000</p>
        </div>
    </div>

    <!-- TABLE -->
     <div class="booked" style="display:none;">


     </div>       
    </div>

</div>
<script src="../javascript/style.js"> </script>
</body>
</html>
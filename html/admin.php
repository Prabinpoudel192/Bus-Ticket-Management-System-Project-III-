<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard - Bus System</title>
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
        <button class="btn1">Dashboard</button>
        <button class="btn2">Active Users</button>
        <button class="btn3">Buses</button>
        <button class="btn4">Logout</button>
    </div>
</div>

<!-- SIDEBAR -->
<div class="sidebar1">
    <button class="btn5">Home</button>
    <button class="btn6">Add Bus</button>
    <button class="btn7">Bookings</button>
    <button class="btn8">Payments</button>
    <button class="btn9">User Registration</button>
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
    <div class="table-box">
        <div class="option-dashboard">
        <h3 style="margin-bottom:10px;" id="tableTitle"></h3>

        <table id="tableHead">
            <tr>
                <th>User</th>
                <th>Bus</th>
                <th>Route</th>
                <th>Seats</th>
                <th>Status</th>
            </tr>

            <tr>
                <td>Prabin</td>
                <td>Express</td>
                <td>KTM → BRT</td>
                <td>3</td>
                <td>Confirmed</td>
            </tr>

            <tr>
                <td>Ram</td>
                <td>Super Fast</td>
                <td>PKR → KTM</td>
                <td>2</td>
                <td>Pending</td>
            </tr>
        </table>
</div>
               <script>
    <div class="option-users" style="display:none;">
    $(document).ready(function(){
    $(".btn2").click(function(){
        alert("i am here");
    $(".option-dashboard").css("display","none");
    $(".option-users").css("display","block");
    $.ajax({
        url:"users-active.php",
        type:"POST",
        
        success:function(data){
        $("#tableTitle").text("Active Users Details");
        $("#tableHead").html(
        <table>
            <tr id="tableHead">
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Address</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Gender</th>
                <th>Username</th>
                <th>Password</th>
                <th>Status</th>
                

        );
        $("#tbbody").html(data);

        }
    });

});
});
$(document).ready(function(){
    $(".btn9").click(function(){
    $(".option-dashboard").css("display","none");
    $(".option-users").css("display","block");
    $.ajax({
        url:"users-inactive.php",
        type:"POST",
        success:function(data){
        $("#tbbody").html(data);

        }
    });

});
});
   </script>
    </table>    
    </div>

</div>

</body>
</html>
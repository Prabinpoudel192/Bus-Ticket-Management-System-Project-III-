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
        <button class="btn1" onClick="tabledisplay()">Dashboard</button>
        <button class="btn2" onClick="tabledisplay()">Active Users</button>
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
    <button class="btn9" onClick="tabledisplay()">User Registration</button>
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
    </table>    
    </div>

</div>
<script src=../javascript/style.js"> </script>
</body>
</html>
<?php
include 'db.php';
$conn = new dbcon();
$conn = $conn->conn;

$vehResult = $conn->query("SELECT vehicle_no FROM bus");

$options = "<option value=''>-- Select Vehicle --</option>";
while($row = $vehResult->fetch_assoc()){
    $veh = $row['vehicle_no'];
    $options .= "<option value='$veh'>$veh</option>";
}

$data="
       <div class='table-box' style='width:35%;'>
       <form action='addstaff.php' method='post'>

        <!-- Company & Owner -->
        <div class='form-group'>
            <label>Staff Full Name</label>
            <input type='text' name='name' placeholder='Full Name' required>
        </div>

        <div class='form-group'>
            <label>Staff Username</label>
            <input type='text' name='username' placeholder='Username' required>
        </div>

        <!-- Vehicle Details -->
        <div class='form-group'>
            <label>Password</label>
            <input type='password' name='password' placeholder='Password' required>
        </div>

        <div class='form-group'>
            <label>Contact No</label>
            <input type='text' name='contact' placeholder='Contact No.' required>
        </div>

        <div class='form-group'>
            <label>Vehicle No</label>
            <select name='assigned_veh' required>
                $options
            </select>
        </div>
        <div class='form-group'>
        <button type='submit' class='submit-btn' name='post3'>Register Staff</button>
        </div>
        </form></div>";
        echo $data;
?>
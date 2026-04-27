<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);
class addbus{
function addbus(){
$data="
<div class='table-box' style='width:35%;'>

    <form action='admin.php' method='post'>

        <!-- Company & Owner -->
        <div class='form-group'>
            <label>Company Name</label>
            <input type='text' name='company_name' required>
        </div>

        <div class='form-group'>
            <label>Owner Name</label>
            <input type='text' name='owner_name' required>
        </div>

        <!-- Vehicle Details -->
        <div class='form-group'>
            <label>Engine No</label>
            <input type='text' name='engine_no' required>
        </div>

        <div class='form-group'>
            <label>Chassis No</label>
            <input type='text' name='chassis_no' required>
        </div>

        <div class='form-group'>
            <label>Vehicle No</label>
            <input type='text' name='vehicle_no' required>
        </div>
        <div class='form-group'>
            <label>NO of Seats</label>
            <input type='number' name='seats' required>
        </div>

        <!-- Route Selection -->
        <div class='form-group'>
            <label>From</label>
            <select name='from_location' required>
                <option value=''>Select City</option>
                <option>Kathmandu</option>
                <option>Bharatpur</option>
                <option>Pokhara</option>
                <option>Butwal</option>
            </select>
        </div>
        <div class='form-group'>
            <label>To</label>
            <select name='to_location' required>
                <option value=''>Select City</option>
                <option>Kathmandu</option>
                <option>Bharatpur</option>
                <option>Pokhara</option>
                <option>Butwal</option>
            </select>
        </div>
         <div class='form-group'>
        <label>Bus Type</label>
        <select name='bus_type' required>
        <option value=''>Select Bus Type</option>
        <option>Express</option>
        <option>Super Express</option>
        <option>Deluxe</option>
        <option>Semi Deluxe</option>
        <option>AC Bus</option>
        <option>Sleeper</option>
        <option>Sleeper + Seater</option>
    </select>
</div>

        <!-- Fare -->
        <div class='form-group'>
            <label>Fare (Rs)</label>
            <input type='number' name='fare' required>
        </div>

        <!-- Time Selection -->
        <div class='form-group'>
            <label>Departure Time</label>
            <input type='time' name='dep_time' required>
        </div>

        <div class='form-group'>
            <label>Arrival Time</label>
            <input type='time' name='arr_time' required>
        </div>

        <!-- Submit -->
        <button type='submit' class='submit-btn' name='post3'>Add Bus</button>

    </form>
</div>";
echo $data;
}
}
$c1=new addbus();
$c1->addbus();
?>
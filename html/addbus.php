<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);
class addbus{
function addbus(){
$data="
<div class='table-box' style='width:35%;'>

    <form action='admin.php' method='post' onsubmit='return validateRoute();'>

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
            <select name='from_location' id='from_location' required onchange='updateOptions()'>
                <option value=''>Select City</option>
                <option>Kathmandu</option>
                <option>Bharatpur</option>
                <option>Pokhara</option>
                <option>Butwal</option>
                <option>Lalitpur</option>
                <option>Bhaktapur</option>
                <option>Lumbini</option>
                <option>Janakpur</option>
                <option>Dharan</option>
                <option>Biratnagar</option>
                <option>Nepalgunj</option>
                <option>Hetauda</option>
                <option>Ilam</option>
                <option>Dhulikhel</option>
                <option>Birtamod</option>
            </select>
        </div>
        <div class='form-group'>
            <label>To</label>
            <select name='to_location' id='to_location' required onchange='updateOptions()'>
                <option value=''>Select City</option>
                <option>Kathmandu</option>
                <option>Bharatpur</option>
                <option>Pokhara</option>
                <option>Butwal</option>
                <option>Lalitpur</option>
                <option>Bhaktapur</option>
                <option>Lumbini</option>
                <option>Janakpur</option>
                <option>Dharan</option>
                <option>Biratnagar</option>
                <option>Nepalgunj</option>
                <option>Hetauda</option>
                <option>Ilam</option>
                <option>Dhulikhel</option>
                <option>Birtamod</option>
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

    <select name='dep_meridiem' required>
        <option value='AM'>AM</option>
        <option value='PM'>PM</option>
    </select>
</div>

<div class='form-group'>
    <label>Arrival Time</label>
    <input type='time' name='arr_time' required>

    <select name='arr_meridiem' required>
        <option value='AM'>AM</option>
        <option value='PM'>PM</option>
    </select>
        </div>

        <!-- Submit -->
        <button type='submit' class='submit-btn' name='post3'>Add Bus</button>

    </form>
</div>

<script>
function updateOptions(){
    var fromSelect = document.getElementById('from_location');
    var toSelect = document.getElementById('to_location');

    var fromVal = fromSelect.value;
    var toVal = toSelect.value;

    // Re-enable all options first
    Array.from(fromSelect.options).forEach(function(opt){ opt.disabled = false; });
    Array.from(toSelect.options).forEach(function(opt){ opt.disabled = false; });

    // Disable the 'from' value inside 'to' select, and vice versa
    Array.from(toSelect.options).forEach(function(opt){
        if(opt.value !== '' && opt.value === fromVal){
            opt.disabled = true;
        }
    });

    Array.from(fromSelect.options).forEach(function(opt){
        if(opt.value !== '' && opt.value === toVal){
            opt.disabled = true;
        }
    });
}

function validateRoute(){
    var fromVal = document.getElementById('from_location').value;
    var toVal = document.getElementById('to_location').value;

    if(fromVal !== '' && fromVal === toVal){
        alert('From and To locations cannot be the same.');
        return false;
    }
    return true;
}
</script>
";
echo $data;
}
}
$c1=new addbus();
$c1->addbus();
?>
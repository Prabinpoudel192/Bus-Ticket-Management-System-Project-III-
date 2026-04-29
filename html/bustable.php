<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);
include 'db.php';
class bustable extends dbcon{
    function display(){
     $sql="select * from bus";
     $r=$this->conn->query($sql);
     $data="
<div class='table-box' style='width:100%'>
    
    <h3 style='margin-bottom:10px;' id='tableTitle'>
        Registration Applicant Details
    </h3>

    <table style='width:100%; border-collapse:collapse;'>
        <thead>
            <tr>
                <th>Company Name</th>
                <th>Owner Name</th>
                <th>Engine Number</th>
                <th>Chassis Number</th>
                <th>Vehicle Number</th>
                <th>Total Seats</th>
                <th>Bus Type</th>
                <th>Route</th>
                <th>Fare</th>
                <th>Arrival Time</th>
                <th>Departure Time</th>
            </tr>
        </thead>

        <tbody>";
   while($row=$r->fetch_assoc()){
    $data.="<tr>
                <td>{$row['company_name']}</td>
                <td>{$row['owner_name']}</td>
                <td>{$row['engine_no']}</td>
                <td>{$row['chassis_no']}</td>
                <td>{$row['vehicle_no']}</td>
                <td>{$row['noofseat']}</td>
                <td>{$row['bus_type']}</td>
                <td>{$row['route']}</td>
                <td>{$row['fare']}</td>
                <td>{$row['arr_time']}</td>
                <td>{$row['dep_time']}</td>
              </tr></tbody>";
    }
    echo $data;
}
}
$c2=new bustable();
$c2->display();
?>
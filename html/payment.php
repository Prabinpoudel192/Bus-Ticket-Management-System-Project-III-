<?php
include 'db.php';

class fetchUsers extends dbcon{

function give(){

$sql="select * from tickets where status='confirm'";
$r=$this->conn->query($sql);

// Variables to store totals
$totalFareSum = 0;
$taxSum = 0;
$grandTotalSum = 0;

$data="
<div class='table-box' style='width:100%'>

    <h3 style='margin-bottom:10px;' id='tableTitle'>
        Unpaid Bookings
    </h3>

    <table style='width:100%; border-collapse:collapse;'>
        <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Mobile</th>
                <th>Company Name</th>
                <th>Route</th>
                <th>Seats</th>
                <th>Travelling Date</th>
                <th>Vehicle No</th>
                <th>Fare</th>
                <th>Total Fare</th>
                <th>Tax</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>";

while($row=$r->fetch_assoc()){

    $totalFareSum += $row['total_fare'];
    $taxSum += $row['tax'];
    $grandTotalSum += $row['total'];

    $data.="
        <tr>
            <td>{$row['name']}</td>
            <td>{$row['address']}</td>
            <td>{$row['mobile']}</td>
            <td>{$row['company_name']}</td>
            <td>{$row['route']}</td>
            <td>{$row['seat']}</td>
            <td>{$row['travel_date']}</td>
            <td>{$row['veh_no']}</td>
            <td>{$row['fare']}</td>
            <td>{$row['total_fare']}</td>
            <td>{$row['tax']}</td>
            <td>{$row['total']}</td>
            <td>{$row['status']}</td>
        </tr>";
}

// Total row
$data.="
<tr style='font-weight:bold; background:#f2f2f2;'>
    <td colspan='9' style='text-align:right;'>Grand Total</td>
    <td>{$totalFareSum}</td>
    <td>{$taxSum}</td>
    <td>{$grandTotalSum}</td>
    <td>-</td>
</tr>";

$data.="</tbody></table></div>";

echo $data;

}

}

$c2=new fetchUsers();
$c2->give();
?>
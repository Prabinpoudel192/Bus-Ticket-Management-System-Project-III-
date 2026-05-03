<?php
include 'db.php';
class fetchUsers extends dbcon{
function give(){
  $sql="select *from tickets where status='pending'";
$r=$this->conn->query($sql);
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
                <th>Total_fare</th>
                <th>Tax</th>
                <th>Total</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>";
   while($row=$r->fetch_assoc()){
    $data.="<tr>
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
                <td><button class='button' id='approve'>Approve</button><br><br><button class='button' id='delete'>Delete</button></td>
              </tr>";
    
   }
   $data.="</tbody></table>";
    echo $data;
}
}
$c2=new fetchUsers();
$c2->give();
?>

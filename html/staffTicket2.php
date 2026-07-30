<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);
include 'db.php';
class fetchBus extends dbcon{
    public $tid;
function __construct($tid){ 
   parent::__construct();
   $this->tid=$tid;
}
function give(){
 $stmt = $this->conn->prepare("SELECT name, address, mobile, company_name, route, seat, travel_date, travel_time, veh_no, total_fare, tax, total FROM tickets WHERE id=?");
$stmt->bind_param("i", $this->tid);
$stmt->execute();
$stmt->bind_result($name, $address, $mobile, $company_name, $route, $seat, $travel_date, $travel_time, $veh_no, $total_fare, $tax, $total);
$found = $stmt->fetch();
$stmt->close();

if (!$found) {
    die("Error in fetching data");
} else {
    $data = "
    <div style='width:420px; margin:auto; padding:20px; border:2px dashed #333; font-family:Arial; background:#fff; color:black;'>
        <h2 style='text-align:center;'>🎟️ BUS TICKET</h2>
        <hr>
        <h4>👤 Passenger Details</h4>
        <p>Name: $name</p>
        <p>Address: $address</p>
        <p>Mobile: $mobile</p>
        <hr>
        <h4>🚌 Bus Details</h4>
        <p>Company: $company_name</p>
        <p>Route: $route</p>
        <p>Seats Booked: $seat</p>
        <p>Date: $travel_date</p>
        <p>Departure: $travel_time</p>
        <p>Vehicle No: $veh_no</p>
        <hr>
        <h4>💰 Fare Summary</h4>
        <p>Base Fare: Rs. <span id='fare'>$total_fare</span></p>
        <p>Tax (13%): Rs. <span id='tax'>$tax</span></p>
        <hr>
        <p><b>Total: Rs. <span id='total'>$total</span></b></p>
        <p style='text-align:center; color:green; font-weight:bold;'>PAID (CASH)</p>
        <hr>
        <div style='text-align:center; margin-top:15px;'>
           <button onclick='window.print()' style='padding:10px 15px; background:#28a745; color:white; border:none; cursor:pointer;'>🖨️ Print Ticket</button>
        </div>
    </div>";
}
echo $data;
}
}
$tid=$_POST['tid'];
$c2=new fetchBus($tid);
$c2->give();
?>
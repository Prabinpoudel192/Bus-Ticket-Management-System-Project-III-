<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);
include 'db.php';
class fetchBus extends dbcon{
    public $uname,$mobile,$date;
function __construct($uname,$mobile){ 
   parent::__construct();
   $this->uname=$uname;
   $this->mobile=$mobile;
}
function give(){
 $date = date('Y-m-d');
 $result = $this->conn->query("select * from tickets where mobile='$this->mobile' and travel_date>='$date'");

 if(!$result || $result->num_rows == 0){
     $data = '<h2 style=\'color:white; margin:100px 0px 0px 50px;\'>No Ticket has been reserved or confirmed.</h2>';
 } else {
     $data = "<div style='display:flex; flex-wrap:wrap; gap:20px; justify-content:center;'>";

     while($login = $result->fetch_assoc()){
         if($login['status']=='pending'){
             $data .= "
<div style='width:420px; max-height:500px; overflow-y:auto; margin:auto; padding:20px; border:2px dashed #333; font-family:Arial; background:#fff;'>

    <h2 style='text-align:center;'>🎟️ BUS TICKET</h2>
    <hr>

    <h4>👤 Passenger Details</h4>
    <p>Name: {$login['name']}</p>
    <p>Address: {$login['address']}</p>
    <p>Mobile: {$login['mobile']}</p>

    <hr>

    <h4>🚌 Bus Details</h4>
    <p>Company: {$login['company_name']}</p>
    <p>Route: {$login['route']}</p>
    <p>Seates Booked:{$login['seat']}</P>
    <p>Date:{$login['travel_date']}</p>
    <p>Departure Time:{$login['travel_time']}</p>
    <p>Vehicle No:{$login['veh_no']} </p>

    <hr>

    <h4>💰 Fare Summary</h4>
    <p>Base Fare: Rs. <span id='fare'>{$login['total_fare']}</span></p>
    <p>Tax (13%): Rs. <span id='tax'>{$login['tax']}</span></p>
    <hr>
    <p><b>Total: Rs. <span id='total'>{$login['total']}</span></b></p>

    <hr>

    <div style='text-align:center; margin-top:15px;'>
       <a href='esewa.php?id={$login['id']}'>
        <button>
            Pay via eSewa
        </button>
    </a>

    </div>

</div>
";
         } else if($login['status']=='confirm'){
             $data .= "
<div style='width:420px; max-height:500px; overflow-y:auto; margin:auto; padding:20px; border:2px dashed #333; font-family:Arial; background:#fff;'>

    <h2 style='text-align:center;'>🎟️ BUS TICKET</h2>
    <hr>

    <h4>👤 Passenger Details</h4>
    <p>Name: {$login['name']}</p>
    <p>Address: {$login['address']}</p>
    <p>Mobile: {$login['mobile']}</p>

    <hr>

    <h4>🚌 Bus Details</h4>
    <p>Company: {$login['company_name']}</p>
    <p>Route: {$login['route']}</p>
    <p>Seates Booked:{$login['seat']}</P>
    <p>Date:{$login['travel_date']}</p>
    <p>Departure Time:{$login['travel_time']}</p>
    <p>Vehicle No:{$login['veh_no']} </p>

    <hr>

    <h4>💰 Fare Summary</h4>
    <p>Base Fare: Rs. <span id='fare'>{$login['total_fare']}</span></p>
    <p>Tax (13%): Rs. <span id='tax'>{$login['tax']}</span></p>
    <hr>
    <p><b>Total: Rs. <span id='total'>{$login['total']}</span></b></p>

    <hr>

    <div style='text-align:center; margin-top:15px;'>
       <button onclick='window.print()'>🖨️ Print</button>
       <button onclick='resetApp()'>🔄 New Booking</button>
    </div>

</div>
";
         }
     }

     $data .= "</div>";
 }

 echo $data;
}
}

$uname=$_POST['uname'];
$mobile=$_POST['mobile'];
$c2=new fetchBus($uname,$mobile);
$c2->give();
?>

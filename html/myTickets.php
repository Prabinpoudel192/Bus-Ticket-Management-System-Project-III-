<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);
include 'db.php';
class fetchBus extends dbcon{
    public $uname,$mobile;
function __construct($uname,$mobile){ 
   parent::__construct();
   $this->uname=$uname;
   $this->mobile=$mobile;
}
function give(){
 $login=$this->conn->query("select *from tickets where mobile=$this->mobile")->fetch_assoc();
 
  if(!$login){
    die("Error in fetching data");
  }else{
    if($login['status']=='pending'){
$data = "
<div style='width:420px; margin:auto; padding:20px; border:2px dashed #333; font-family:Arial; background:#fff;'>

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
    <p>Vehicle No:{$login['veh_no']} </p>

    <hr>

    <h4>💰 Fare Summary</h4>
    <p>Base Fare: Rs. <span id='fare'>{$login['total_fare']}</span></p>
    <p>Tax (13%): Rs. <span id='tax'>{$login['tax']}</span></p>
    <hr>
    <p><b>Total: Rs. <span id='total'>{$login['total']}</span></b></p>

    <hr>

    <div style='text-align:center; margin-top:15px;'>
       <a href='esewa.php?id=$insert_val'>
        <button
            style='padding:10px 15px; background:#ff6600; color:white; border:none; cursor:pointer; margin-left:10px;'>
            Pay via eSewa
        </button>
    </a>

    </div>
    

</div>
";
    }else if($login['status']=='confirm'){
       $data = "
<div style='width:420px; margin:auto; padding:20px; border:2px dashed #333; font-family:Arial; background:#fff;'>

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
   echo $data;
}
}

$uname=$_POST['uname'];
$mobile=$_POST['mobile'];
$c2=new fetchBus($uname,$mobile);
$c2->give();
?>

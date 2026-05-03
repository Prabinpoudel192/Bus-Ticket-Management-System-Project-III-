<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);
include 'db.php';
class fetchBus extends dbcon{
    public $route,$date,$time,$id,$uname,$veh,$seat;
function __construct($route,$date,$time,$id,$uname,$veh,$seat){ 
   parent::__construct();
   $this->route=$route;
   $this->date=$date;
   $this->time=$time;
   $this->id=$id;
   $this->uname=$uname;
   $this->veh=$veh;
   $this->seat=$seat;
}
function give(){
 $login=$this->conn->query("select fname,lname,address,mobile from login where id=$this->id")->fetch_assoc();
 $bus=$this->conn->query("select company_name,route,dep_time,fare from bus where vehicle_no='$this->veh'")->fetch_assoc();
  if(!$login && !$bus){
    die("Error in fetching data");
  }else{
    //These values is to be inserted in the database
    $tic_num = is_array($this->seat) ? count($this->seat) : 1;
    $total_fare = $bus['fare'] * $tic_num;
    $tax = $total_fare * 0.13;
    $total=$total_fare+$tax;
    $str = is_array($this->seat)
    ? implode(", ", $this->seat)
    : $this->seat;
    $fullname = $login['fname'] . " " . $login['lname'];
    $address = $login['address'];
    $mobile = $login['mobile'];
    $company = $bus['company_name'];
    $route = $bus['route'];
    $fare = $bus['fare'];
    $fullname=$login['fname']." ".$login['lname'];
    $sql = "INSERT INTO tickets 
    (name, address, mobile, company_name, route, seat, travel_date, veh_no, fare, total_fare, tax,status)
     VALUES 
    ('$fullname', '$address', '$mobile', '$company', '$route', '$str', '$this->date', '$this->veh', '$fare', '$total_fare', '$tax','pending')";
    $row=$this->conn->query($sql);
    if(!$row){
        die("Ticket can't be confirmed, Try again!!!");
    }else{
    
    
$data = "
<div style='width:420px; margin:auto; padding:20px; border:2px dashed #333; font-family:Arial; background:#fff;'>

    <h2 style='text-align:center;'>🎟️ BUS TICKET</h2>
    <hr>

    <h4>👤 Passenger Details</h4>
    <p>Name: {$login['fname']} {$login['lname']}</p>
    <p>Address: {$login['address']}</p>
    <p>Mobile: {$login['mobile']}</p>

    <hr>

    <h4>🚌 Bus Details</h4>
    <p>Company: {$bus['company_name']}</p>
    <p>Route: {$bus['route']}</p>
    <p>Seates Booked:$str</P>
    <p>NOOFBooking:$tic_num</p>
    <p>Date:$this->date</p>
    <p>Departure: {$bus['dep_time']}</p>
    <p>Vehicle No: $this->veh</p>

    <hr>

    <h4>💰 Fare Summary</h4>
    <p>Base Fare: Rs. <span id='fare'>$total_fare</span></p>
    <p>Tax (13%): Rs. <span id='tax'>$tax</span></p>
    <hr>
    <p><b>Total: Rs. <span id='total'>$total</span></b></p>

    <hr>

    <div style='text-align:center; margin-top:15px;'>

        <button style='padding:10px 15px; background:green; color:white; border:none; cursor:pointer;'>
            Reserve Ticket
        </button>

        <button style='padding:10px 15px; background:#ff6600; color:white; border:none; cursor:pointer; margin-left:10px;'>
            Pay via eSewa
        </button>

    </div>

</div>
";
   
   }
   echo $data;
}
}}
$route=$_POST['route'];
$date=$_POST['date'];
$time=$_POST['time'];
$id=$_POST['id'];
$uname=$_POST['uname'];
$veh=$_POST['veh'];
$seat=$_POST['seat'];
$c2=new fetchBus($route,$date,$time,$id,$uname,$veh,$seat);
$c2->give();
?>

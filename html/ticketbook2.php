<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);
include 'db.php';
class fetchBus extends dbcon{
    public $route,$date,$time,$id,$uname,$veh;
function __construct($route,$date,$time,$id,$uname,$veh){ 
   parent::__construct();
   $this->route=$route;
   $this->date=$date;
   $this->time=$time;
   $this->id=$id;
   $this->uname=$uname;
   $this->veh=$veh;
}
function give(){
 $login=$this->conn->query("select fname,lname,address,mobile from login where id=$this->id")->fetch_assoc();
 $bus=$this->conn->query("select company_name,route,dep_time from bus where vehicle_no='$this->veh'")->fetch_assoc();
  if(!$login && !$bus){
    die("Error in fetching data");
  }else{
$data="
<div class='table-box' style='width:100%'>
    
    <h3 style='margin-bottom:10px;' id='tableTitle'>
        Available Busses
    </h3>

    <table style='width:100%; border-collapse:collapse;'>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Address</th>
                <th>Mobile</th>
                <th>Company Name</th>
                <th>route</th>
                <th>Departure Time</th>
                <th>Vehicle NO</th>
            </tr>
        </thead>

        <tbody>";
  
    $data.="<tr>
                <td>{$login['fname']}</td>
                <td>{$login['lname']}</td>
                <td>{$login['address']}</td>
                <td>{$login['mobile']}</td>
                <td>{$bus['company_name']}</td>
                <td>{$bus['route']}</td>
                <td>{$bus['dep_time']}</td>
                <td>$this->veh</td></tr>";
               //<td><button onclick=\"showPage('booking',{$row['noofseat']})\">🎟️ Book Ticket</button></td> 
              
    
   }
   echo $data.="</tbody></table>";
   
   }
}

$route=$_POST['route'];
$date=$_POST['date'];
$time=$_POST['time'];
$id=$_POST['id'];
$uname=$_POST['uname'];
$veh=$_POST['veh'];
$c2=new fetchBus($route,$date,$time,$id,$uname,$veh);
$c2->give();
?>

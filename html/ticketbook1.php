<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);
include 'db.php';
class fetchBus extends dbcon{
    public $route,$date,$time;
function __construct($route,$date,$time){ 
   parent::__construct();
   $this->route=$route;
   $this->date=$date;
   $this->time=$time;
}
function give(){
  $sql="select company_name,vehicle_no,noofseat,bus_type,route,fare,dep_time from bus where route='$this->route' and dep_time='$this->time'";
  $r=$this->conn->query($sql);
  if(!$r){
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
                <th>Company_name</th>
                <th>Vehicle No</th>
                <th>No of Seats</th>
                <th>Bus Type</th>
                <th>Route</th>
                <th>Fare</th>
                <th>Departure Time</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>";
   while($row=$r->fetch_assoc()){
    $data.="<tr>
                <td>{$row['company_name']}</td>
                <td>{$row['vehicle_no']}</td>
                <td>{$row['noofseat']}</td>
                <td>{$row['bus_type']}</td>
                <td>{$row['route']}</td>
                <td>{$row['fare']}</td>
                <td>{$row['dep_time']}</td>
                <td><button onclick=\"showPage('booking',{$row['noofseat']})\">🎟️ Book Ticket</button></td>
              </tr>";
    
   }
   echo $data.="</tbody></table>";
   }
}
}
$route=$_POST['route'];
$date=$_POST['date'];
$time=$_POST['time'];
$c2=new fetchBus($route,$date,$time);
$c2->give();
?>

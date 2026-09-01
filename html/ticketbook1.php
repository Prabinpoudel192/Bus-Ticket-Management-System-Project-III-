<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);
include 'db.php';
include 'algorithms.php'; // Merge Sort algorithm used below
class fetchBus extends dbcon{
    public $route;
    public $date;
    public $qt;
function __construct($route,$date,$qt){ 
   parent::__construct();
   $this->route=$route;
   $this->date=$date;
   $this->qt=$qt;
}
function give(){
  $sql="select company_name,vehicle_no,noofseat,bus_type,route,fare,dep_time from bus where route='$this->route'";
  $r=$this->conn->query($sql);
  if(!$r){
    die("Error in fetching data");
  }else{
    // Collect all matching buses first
    $buses = [];
    while($row=$r->fetch_assoc()){
        $buses[] = $row;
    }

    // Standard Algorithm: Merge Sort (O(n log n))
    // Sort available buses by fare, cheapest first, so passengers
    // see the most affordable options at the top of the list.
    $buses = mergeSort($buses, 'fare', false);

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
   foreach($buses as $row){
    $data.="<tr>
                <td>{$row['company_name']}</td>
                <td>{$row['vehicle_no']}</td>
                <td>{$row['noofseat']}</td>
                <td>{$row['bus_type']}</td>
                <td>{$row['route']}</td>
                <td>{$row['fare']}</td>
                <td>{$row['dep_time']}</td>
                <td><button onclick=\"showPage('booking',{$row['noofseat']},'{$row['vehicle_no']}','$this->date',$this->qt)\">🎟️ Book Ticket</button></td>
              </tr>";
    
   }
   echo $data.="</tbody></table>";
   }
}
}
$proute=$_POST['route'];
$pdate=$_POST['date'];
$type=$_POST['qt'];
$c2=new fetchBus($proute,$pdate,$type);
$c2->give();
?>

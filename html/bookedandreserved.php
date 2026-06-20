<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);
include 'db.php';
class Booked extends dbcon{
    public $vehno;
    public $data=[];
function __construct($vehno){ 
   parent::__construct();
   $this->vehno=$vehno;
}
function give(){
  $sql="select seat from tickets where veh_no='$this->vehno'";
  $r=$this->conn->query($sql);
  if(!$r){
    die("Error in fetching data");
  }else{

   while($row=$r->fetch_assoc()){
   $this->data[]=$row;
    
   }
   
   }
   echo json_encode($this->data);
}
}
$vehno=$_POST['vehno'];
$c2=new Booked($vehno);
$c2->give();
?>
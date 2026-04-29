<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);
class registerbus{
 protected $company_name,$owner_name,$engine_no,$chassis_no,$vehicle_no,$seats,$bus_type,$route,$fare,$arr_time,$dep_time;
 function __construct($company_name,$owner_name,$engine_no,$chassis_no,$vehicle_no,$seats,$bus_type,$route,$fare,$arr_time,$dep_time){
    
    $this->company_name=$company_name;
    $this->owner_name=$owner_name;
    $this->engine_no=$engine_no;
    $this->chassis_no=$chassis_no;
    $this->vehicle_no=$vehicle_no;
    $this->seats=$seats;
    $this->bus_type=$bus_type;
    $this->route=$route;
    $this->fare=$fare;
    $this->arr_time=$arr_time;
    $this->dep_time=$dep_time;
 }
function insert($conn){    
        try{
        $sql="insert into bus(company_name,owner_name,engine_no,chassis_no,vehicle_no,noofseat,bus_type,route,fare,arr_time,dep_time) values('$this->company_name','$this->owner_name','$this->engine_no','$this->chassis_no','$this->vehicle_no','$this->seats','$this->bus_type','$this->route','$this->fare','$this->arr_time','$this->dep_time')";
        $r=$conn->query($sql); 
        return "done";
        }catch(mysqli_sql_exception $e){
           $msg = addslashes($e->getMessage())."-Sorry,couldn't register the bus";
        return "<script>alert('$msg')</script>";
        
        
    }
    }
}
?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php';
class userApprove extends dbcon{
    public $id,$task,$data;
    function __construct($id,$task){
        parent::__construct();
        $this->id=$id;
        $this->task=$task;
    }
function give(){
    $data="";
    if($this->task=='app'){
  $sql="update login set acc=2,status='active' where id=$this->id";
    $r=$this->conn->query($sql);
    if($r){
        $data="User has been approved";
    }else{
        die("Error in the query");
    }
    }else if($this->task=='del'){
    $sql="delete from login where id=$this->id";
    $r=$this->conn->query($sql);
     if($r){
        $data="User has been Deleted";
    }else{
        die("Error in the query");
    }
    }else if($this->task=='admin'){
    $sql="update login set acc=3,status='active' where id=$this->id";
    $r=$this->conn->query($sql);
     if($r){
        $data="User has been approved as admin";
    }else{
        die("Error in the query");
    }
    }
    echo $data;
}
}
$id = $_POST['id'];
$task=$_POST['task'];
$c2=new userApprove($id,$task);
$c2->give();
?>

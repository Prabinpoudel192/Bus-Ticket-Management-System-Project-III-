<?php
class dbcon{
    public $conn;
function __construct(){
    
$this->conn=new mysqli("localhost","bus","2232","projectiii");
if($this->conn->connect_error){


    die("No Database connection".$this->conn->connect_error);
    
   
    }
}
}
?>

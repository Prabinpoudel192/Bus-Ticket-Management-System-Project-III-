<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);
include 'db.php';

class del extends dbcon {
    public $present;
    public $today;

    public function __construct() {
        parent::__construct();
        $this->present = time();
        $this->today = date('Y-m-d');
    }

function dele(){


$sql = "DELETE FROM tickets WHERE travel_date='$this->today' and status='pending' and expire < $this->present";

$r = $this->conn->query($sql);
}
function verify(){
    

   echo json_encode($this->present ."  ".$this->today);
}
}

$c2 = new del();
$c2->dele();
//$c2->verify();
?>
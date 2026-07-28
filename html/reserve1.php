<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);
include 'db.php';
class Booked extends dbcon{
    public $vehno;
    public $date;
    public $pending = [];
    public $confirmed = [];
function __construct($vehno){ 
   parent::__construct();
   $this->vehno=$vehno;
   $this->date=date('Y-m-d');
}
 function give() {
    $sql = "SELECT seat FROM tickets
            WHERE veh_no='$this->vehno'
            AND travel_date='$this->date'
            AND status='pending'";
    $r = $this->conn->query($sql);
    while ($row = $r->fetch_assoc()) {
        $this->pending[] = $row;
    }
    $sql = "SELECT seat FROM tickets
            WHERE veh_no='$this->vehno'
            AND travel_date='$this->date'
            AND status='confirm'";
    $r = $this->conn->query($sql);
    while ($row = $r->fetch_assoc()) {
        $this->confirmed[] = $row;
    }
    echo json_encode([
        "pending" => $this->pending,
        "confirmed" => $this->confirmed
    ]);
}
}
$vehno=$_POST['vehno'];
$c2=new Booked($vehno);
$c2->give();
?>
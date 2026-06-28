<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php';

class fetchUsers extends dbcon
{
    function __construct()
    {
        parent::__construct();
    }

    function give()
    {
        $rev = 0;

        // Total Active Users
        $r = $this->conn->query("SELECT * FROM login WHERE status='active'");
        $total_users = $r->num_rows;

        // Total Buses
        $rr = $this->conn->query("SELECT * FROM bus");
        $total_buses = $rr->num_rows;

        // Total Confirmed Bookings
        $rrr = $this->conn->query("SELECT * FROM tickets WHERE status='confirm'");
        $total_booking = $rrr->num_rows;

        // Total Revenue
        $sql = $this->conn->query("SELECT total FROM tickets WHERE status='confirm'");

        while ($row = $sql->fetch_assoc()) {
            $rev += (float)$row['total'];
        }

        echo json_encode([
            "total_users"   => $total_users,
            "total_buses"   => $total_buses,
            "total_booking" => $total_booking,
            "revenue"       => $rev
        ]);
    }
}

$c2 = new fetchUsers();
$c2->give();
?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php';

class fetchAdBookings extends dbcon{
function __construct(){
    parent::__construct();
}
function give(){
    $sql = "SELECT * FROM ad_bookings WHERE status='pending' ORDER BY booked_at DESC";
    $r = $this->conn->query($sql);

    $data = "
    <div class='table-box' style='width:100%; overflow:auto;'>
        <h3 style='margin-bottom:10px;'>Pending Package / Ad Booking Requests</h3>
        <table style='width:100%; border-collapse:collapse;' border='1' cellpadding='8'>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>Package</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Requested At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>";

    if ($r->num_rows === 0) {
        $data .= "<tr><td colspan='8' style='text-align:center;'>No pending booking requests.</td></tr>";
    }

    while ($row = $r->fetch_assoc()) {
        $data .= "
            <tr>
                <td>{$row['name']}</td>
                <td>{$row['mobile']}</td>
                <td>{$row['address']}</td>
                <td>{$row['ad_title']}</td>
                <td>{$row['category']}</td>
                <td>{$row['price']}</td>
                <td>{$row['booked_at']}</td>
                <td><button class='confirm-ad-btn' data-id='{$row['id']}'>Confirm</button></td>
            </tr>";
    }

    $data .= "</tbody></table></div>";
    echo $data;
}
}

$c2 = new fetchAdBookings();
$c2->give();
?>
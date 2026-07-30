<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('Asia/Kathmandu');
include 'db.php';

$conn = new dbcon();
$conn = $conn->conn;

$veh_no = $_GET['veh_no'] ?? '';
$seats = $_GET['bseats'] ?? '';
$company = $_GET['bcompany'] ?? '';

$triggerScript = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $company_name = $_POST['company_name'];
    $from = $_POST['from'];
    $to = $_POST['to'];
    $route = $from . "-" . $to;
    $seat = $_POST['seat'];
    $travel_date = $_POST['date'];
    $travel_time = $_POST['travel_time'];
    $veh_no_post = $_POST['veh_no'];
    $fare = $_POST['fare'];
    $total_fare = $fare * (substr_count($seat, ',') + 1);
    $tax = $total_fare * 0.13;

    $stmt = $conn->prepare("INSERT INTO tickets (name, address, mobile, company_name, route, seat, travel_date, travel_time, veh_no, fare, total_fare, tax, status, payment_method, expire) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'confirm', 'cash', 0)");
    $stmt->bind_param("sssssssssddd", $name, $address, $mobile, $company_name, $route, $seat, $travel_date, $travel_time, $veh_no_post, $fare, $total_fare, $tax);

    if ($stmt->execute()) {
        $ticket_id = $conn->insert_id;
        $triggerScript = "generateTicket($ticket_id);";
        } else {
        $err = addslashes($stmt->error);
        $triggerScript = "alert('Insert failed: " . $err . "');";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Cash Booking - Bus Ticket Booking System</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/index.css">
<script src="../javascript/jquery.js"></script>
<script src="../javascript/staff.js"></script>
</head>
<body>

<!-- NAVBAR -->
<div class="navbar1">
    <h2>🚍 Cash Booking</h2>
    <div class="nav-buttons">
        <button class="btn4" onclick="window.location.href='staffuser.php'">Back</button>
    </div>
</div>

<!-- SIDEBAR -->
<div class="sidebar1">
    <button class="btn6">Add Ticket (Cash)</button>
</div>

<!-- Target div generateTicket()/staff.js writes the ticket HTML into -->
<div class="display" style="display:none;"></div>

<!-- MAIN CONTENT -->
<div class="main container" id="cashFormSection">

    <h2>Add Ticket - Cash Payment</h2>

    <div class="table-box" style="width:35%;">
    <form method="post">

        <div class="form-group">
            <label>Passenger Name</label>
            <input type="text" name="name" placeholder="Full Name" required>
        </div>

        <div class="form-group">
            <label>Address</label>
            <input type="text" name="address" placeholder="Address" required>
        </div>

        <div class="form-group">
            <label>Mobile</label>
            <input type="text" name="mobile" placeholder="Mobile Number" required>
        </div>

        <div class="form-group">
            <label>Company Name</label>
            <input type="text" name="company_name" value="<?= htmlspecialchars($company) ?>" readonly>
        </div>

        <div class="form-group" style="display:flex; align-items:center; gap:10px;">
        <label style="white-space:nowrap;">Route</label>
        <div style="display:flex; gap:5px; flex:1;">
          <input type="text" name="from" placeholder="From" required style="width:50%;">
          <input type="text" name="to" placeholder="To" required style="width:50%;">
        </div>
        </div>

        <div class="form-group">
            <label>Seat</label>
            <input type="text" name="seat" value="<?= htmlspecialchars($seats) ?>" readonly>
        </div>

        <div class="form-group">
            <label>Travel Date</label>
            <input type="date" name="date" value="<?= date('Y-m-d') ?>" readonly>
        </div>

        <div class="form-group">
            <label>Travel Time</label>
            <input type="text" name="travel_time" value="<?= date('h:i A') ?>" readonly>
        </div>

        <div class="form-group">
            <label>Vehicle No</label>
            <input type="text" name="veh_no" value="<?= htmlspecialchars($veh_no) ?>" readonly>
        </div>

        <div class="form-group">
            <label>Fare</label>
            <input type="number" step="0.01" name="fare" placeholder="Fare" required>
        </div>

        <div class="form-group">
            <button type="submit" class="submit-btn">Add Ticket</button>
        </div>

    </form>
    </div>

</div>

<?php if ($triggerScript): ?>
<script>
$(document).ready(function(){
    $("#cashFormSection").hide();
    <?= $triggerScript ?>
});
</script>
<?php endif; ?>

</body>
</html>
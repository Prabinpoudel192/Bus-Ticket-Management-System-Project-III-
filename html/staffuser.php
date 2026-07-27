<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);
include 'db.php';

$conn = new dbcon();
$conn = $conn->conn;

// Fetch vehicles for dropdown
$vehResult = $conn->query("SELECT vehicle_no, company_name, route, fare, dep_time FROM bus");

$message = "";

// Handle form submission
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $veh_no = $_POST['veh_no'];
    $seat = $_POST['seat'];
    $travel_date = $_POST['travel_date'];

    // Get bus details for fare calculation
    $stmt = $conn->prepare("SELECT company_name, route, fare, dep_time FROM bus WHERE vehicle_no=?");
    $stmt->bind_param("s", $veh_no);
    $stmt->execute();
    $bus = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if($bus){
        $fare = $bus['fare'];
        $tax = $fare * 0.13;
        $total_fare = $fare;

        $stmt = $conn->prepare("INSERT INTO tickets (name, address, mobile, company_name, route, seat, travel_date, travel_time, veh_no, fare, total_fare, tax, status, expire) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'confirm', 0)");
        $stmt->bind_param("sssssssssddd", $name, $address, $mobile, $bus['company_name'], $bus['route'], $seat, $travel_date, $bus['dep_time'], $veh_no, $fare, $total_fare, $tax);

        if($stmt->execute()){
            $message = "<p style='color:green;'>Seat booked successfully for $name. Payment received in cash.</p>";
        } else {
            $message = "<p style='color:red;'>Booking failed: " . $stmt->error . "</p>";
        }
        $stmt->close();
    } else {
        $message = "<p style='color:red;'>Invalid vehicle selected.</p>";
    }
}

// Build vehicle dropdown options
$vehOptions = "<option value=''>-- Select Vehicle --</option>";
$vehResult->data_seek(0);
while($row = $vehResult->fetch_assoc()){
    $vehOptions .= "<option value='{$row['vehicle_no']}'>{$row['vehicle_no']} - {$row['company_name']} ({$row['route']})</option>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Staff - Book Seat (Cash)</title>
</head>
<body>

<div style="width:400px; margin:50px auto; padding:20px; border:1px solid #ccc; font-family:Arial;">
    <h2>Book Seat - Cash Payment</h2>

    <?= $message ?>

    <form method="POST">
        <div style="margin-bottom:10px;">
            <label>Passenger Name</label><br>
            <input type="text" name="name" required style="width:100%;">
        </div>

        <div style="margin-bottom:10px;">
            <label>Mobile</label><br>
            <input type="text" name="mobile" required style="width:100%;">
        </div>

        <div style="margin-bottom:10px;">
            <label>Address</label><br>
            <input type="text" name="address" required style="width:100%;">
        </div>

        <div style="margin-bottom:10px;">
            <label>Vehicle</label><br>
            <select name="veh_no" required style="width:100%;">
                <?= $vehOptions ?>
            </select>
        </div>

        <div style="margin-bottom:10px;">
            <label>Seat Number</label><br>
            <input type="text" name="seat" required style="width:100%;">
        </div>

        <div style="margin-bottom:10px;">
            <label>Travel Date</label><br>
            <input type="date" name="travel_date" min="<?= date('Y-m-d') ?>" required style="width:100%;">
        </div>

        <button type="submit" style="padding:10px 20px;">Book Seat (Cash)</button>
    </form>
</div>

</body>
</html>
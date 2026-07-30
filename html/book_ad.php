<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'db.php';
header('Content-Type: application/json');

$c1 = new dbcon();
$conn = $c1->conn;

if (!isset($_SESSION['u_id'])) {
    echo json_encode(["status" => "login_required"]);
    exit();
}

$user_id = $_SESSION['u_id'];
$ad_id = $_POST['ad_id'] ?? 0;

if (!$ad_id) {
    echo json_encode(["status" => "error"]);
    exit();
}

// Fetch ad details
$stmt = $conn->prepare("SELECT title, price, category FROM ads WHERE id = ?");
$stmt->bind_param("i", $ad_id);
$stmt->execute();
$adRow = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$adRow) {
    echo json_encode(["status" => "error"]);
    exit();
}

// Fetch user details from login table
$stmt = $conn->prepare("SELECT fname, mname, lname, address, mobile FROM login WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$userRow = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$userRow) {
    echo json_encode(["status" => "error"]);
    exit();
}

$name = trim($userRow['fname'] . ' ' . $userRow['mname'] . ' ' . $userRow['lname']);
$mobile = $userRow['mobile'];
$address = $userRow['address'];

// Prevent duplicate pending/confirmed requests for the same ad by the same user
$stmt = $conn->prepare("SELECT id FROM ad_bookings WHERE ad_id = ? AND user_id = ? AND status IN ('pending','confirm')");
$stmt->bind_param("ii", $ad_id, $user_id);
$stmt->execute();
$existing = $stmt->get_result()->fetch_assoc();
$stmt->close();

if ($existing) {
    echo json_encode(["status" => "duplicate"]);
    exit();
}

$stmt = $conn->prepare("INSERT INTO ad_bookings (ad_id, user_id, name, mobile, address, ad_title, category, price, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'pending')");
$stmt->bind_param("iissssss", $ad_id, $user_id, $name, $mobile, $address, $adRow['title'], $adRow['category'], $adRow['price']);

if ($stmt->execute()) {
    echo json_encode(["status" => "done"]);
} else {
    echo json_encode(["status" => "error"]);
}
$stmt->close();
?>
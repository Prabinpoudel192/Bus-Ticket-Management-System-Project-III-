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

// Get form values
$ad_id   = $_POST['ad_id'] ?? 0;
$name    = trim($_POST['name'] ?? '');
$mobile  = trim($_POST['mobile'] ?? '');
$address = trim($_POST['address'] ?? '');

if (!$ad_id || $name == '' || $mobile == '' || $address == '') {
    echo json_encode(["status" => "error"]);
    exit();
}

// Fetch advertisement details
$stmt = $conn->prepare("SELECT title, price, category FROM ads WHERE id = ?");
$stmt->bind_param("i", $ad_id);
$stmt->execute();
$adRow = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$adRow) {
    echo json_encode(["status" => "error"]);
    exit();
}

// Prevent duplicate booking
$stmt = $conn->prepare("SELECT id FROM ad_bookings WHERE ad_id = ? AND user_id = ? AND status IN ('pending','confirm')");
$stmt->bind_param("ii", $ad_id, $user_id);
$stmt->execute();
$existing = $stmt->get_result()->fetch_assoc();
$stmt->close();

if ($existing) {
    echo json_encode(["status" => "duplicate"]);
    exit();
}

// Insert booking
$stmt = $conn->prepare("
    INSERT INTO ad_bookings
    (
        ad_id,
        user_id,
        name,
        mobile,
        address,
        ad_title,
        category,
        price,
        status
    )
    VALUES
    (
        ?, ?, ?, ?, ?, ?, ?, ?, 'pending'
    )
");

$stmt->bind_param(
    "iissssss",
    $ad_id,
    $user_id,
    $name,
    $mobile,
    $address,
    $adRow['title'],
    $adRow['category'],
    $adRow['price']
);

if ($stmt->execute()) {
    echo json_encode(["status" => "done"]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => $stmt->error
    ]);
}

$stmt->close();
$conn->close();
?>
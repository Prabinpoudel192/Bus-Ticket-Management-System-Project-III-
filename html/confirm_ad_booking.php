<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php';
header('Content-Type: application/json');

$c1 = new dbcon();
$conn = $c1->conn;

$id = $_POST['id'] ?? 0;

if (!$id) {
    echo json_encode(["status" => "error"]);
    exit();
}

$stmt = $conn->prepare("UPDATE ad_bookings SET status='confirm' WHERE id=?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(["status" => "done"]);
} else {
    echo json_encode(["status" => "error"]);
}
$stmt->close();
?>
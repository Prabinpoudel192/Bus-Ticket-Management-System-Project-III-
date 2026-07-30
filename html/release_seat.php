<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php';

$conn = new dbcon();
$conn = $conn->conn;

$id = $_POST['id'] ?? null;
if (!$id) { die("No ID provided."); }

$stmt = $conn->prepare("UPDATE tickets SET seat=NULL WHERE id=?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "<p style='color:green;'>Seat released successfully.</p>";
} else {
    $err = addslashes($stmt->error);
    echo "<p style='color:red;'>Failed to release seat: $err</p>";
}
$stmt->close();
?>
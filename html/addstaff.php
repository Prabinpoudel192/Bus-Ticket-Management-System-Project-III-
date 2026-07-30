<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);
include 'db.php';

$conn = new dbcon();
$conn = $conn->conn;

$name = $_POST['name'];
$username = $_POST['username'];
$password =$_POST['password'];
$contact = $_POST['contact'];
$assigned_veh = $_POST['assigned_veh'];
$acc=4;
$stmt = $conn->prepare("INSERT INTO staff (name, username, password, contact, assigned_veh,acc) VALUES (?, ?, ?, ?, ?,?)");
$stmt->bind_param("sssssi", $name, $username, $password, $contact, $assigned_veh,$acc);

if($stmt->execute()){
    echo "<script>alert('Staff registered successfully'); window.location.href='admin.php';</script>";
} else {
    echo "<script>alert('Staff registration was unsuccessful.');</script>";
}

$stmt->close();
?>
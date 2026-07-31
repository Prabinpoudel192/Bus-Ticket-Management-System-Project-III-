<?php
session_start();

if(!isset($_SESSION['u_id'])){
    header("Location: index.php");
    exit();
}

include 'db.php';
$c1 = new dbcon();

$id = $_SESSION['u_id'];

$stmt = $c1->conn->prepare("SELECT fname, mname, lname, address, email, mobile, gender, uname, acc, status FROM login WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if(!$user){
    echo "User not found.";
    exit();
}

$fullName = trim($user['fname'].' '.($user['mname'] ? $user['mname'].' ' : '').$user['lname']);
$accType = $user['acc'] == 2 ? 'Customer' : 'Admin';
$initials = strtoupper(substr($user['fname'] ?? 'U', 0, 1).substr($user['lname'] ?? '', 0, 1));
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/user.css">
<title>My Profile</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    background:#f4f7fb;
}

.navbar{
    width:100%;
    height:70px;
    background:#1e3c72;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:0 30px;
    color:white;
    box-shadow:0 2px 10px rgba(0,0,0,.3);
}

.navbar .logo{
    font-size:22px;
    font-weight:bold;
}

.navbar button{
    padding:10px 20px;
    border:none;
    border-radius:6px;
    background:white;
    color:#1e3c72;
    cursor:pointer;
    font-weight:bold;
}

.profile-wrap{
    max-width:600px;
    margin:40px auto;
    padding:0 20px;
}

.profile-card{
    background:#fff;
    border-radius:12px;
    box-shadow:0 3px 15px rgba(0,0,0,.15);
    overflow:hidden;
}

.profile-header{
    background:linear-gradient(135deg,#1e3c72,#2a5298);
    color:#fff;
    padding:30px;
    display:flex;
    align-items:center;
    gap:20px;
}

.avatar{
    width:70px;
    height:70px;
    border-radius:50%;
    background:#fff;
    color:#1e3c72;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:26px;
    font-weight:bold;
    flex-shrink:0;
}

.profile-header h2{
    margin-bottom:4px;
}

.profile-header p{
    opacity:.85;
    font-size:14px;
}

.profile-body{
    padding:25px 30px;
}

.info-row{
    display:flex;
    justify-content:space-between;
    padding:12px 0;
    border-bottom:1px solid #eee;
}

.info-row:last-child{
    border-bottom:none;
}

.info-label{
    color:#888;
    font-size:14px;
}

.info-value{
    color:#2c3e50;
    font-weight:600;
    font-size:14px;
    text-align:right;
}

.status-badge{
    display:inline-block;
    padding:3px 10px;
    border-radius:12px;
    font-size:12px;
    color:#fff;
    background:<?= $user['status']=='active' ? '#27ae60' : '#c0392b' ?>;
}
</style>
</head>
<body>

<div class="navbar">
<div class="logo">My Profile</div>
<button onclick="window.location.href='user.php'">Back to Home</button>
</div>

<div class="profile-wrap">
<div class="profile-card">

    <div class="profile-header">
        <div class="avatar"><?= htmlspecialchars($initials) ?></div>
        <div>
            <h2><?= htmlspecialchars($fullName ?: $user['uname']) ?></h2>
            <p>@<?= htmlspecialchars($user['uname']) ?></p>
        </div>
    </div>

    <div class="profile-body">

        <div class="info-row">
            <span class="info-label">Full Name</span>
            <span class="info-value"><?= htmlspecialchars($fullName ?: '-') ?></span>
        </div>

        <div class="info-row">
            <span class="info-label">Email</span>
            <span class="info-value"><?= htmlspecialchars($user['email'] ?: '-') ?></span>
        </div>

        <div class="info-row">
            <span class="info-label">Mobile</span>
            <span class="info-value"><?= htmlspecialchars($user['mobile'] ?: '-') ?></span>
        </div>

        <div class="info-row">
            <span class="info-label">Address</span>
            <span class="info-value"><?= htmlspecialchars($user['address'] ?: '-') ?></span>
        </div>

        <div class="info-row">
            <span class="info-label">Gender</span>
            <span class="info-value"><?= htmlspecialchars($user['gender'] ?: '-') ?></span>
        </div>

        <div class="info-row">
            <span class="info-label">Account Type</span>
            <span class="info-value"><?= htmlspecialchars($accType) ?></span>
        </div>

        <div class="info-row">
            <span class="info-label">Status</span>
            <span class="info-value"><span class="status-badge"><?= htmlspecialchars(ucfirst($user['status'] ?: '-')) ?></span></span>
        </div>

    </div>

</div>
</div>

</body>
</html>
<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);
include 'db.php';
include 'registerbus.php';
include 'ads.php';

if(isset($_POST['post3'])){
    $company_name=$_POST['company_name'];
    $owner_name=$_POST['owner_name'];
    $engine_no=$_POST['engine_no'];
    $chassis_no=$_POST['chassis_no'];
    $vehicle_no=$_POST['vehicle_no'];
    $seats=$_POST['seats'];
    $bus_type=$_POST['bus_type'];
    $start=$_POST['from_location'];
    $end=$_POST['to_location'];
    $fare=$_POST['fare'];
    $arr_time=$_POST['arr_time']." ".$_POST['arr_meridiem'];
    $dep_time=$_POST['dep_time']." ".$_POST['dep_meridiem'];
    $route=$start."-".$end;
        $c1=new dbcon();
        $c2=new registerbus($company_name,$owner_name,$engine_no,$chassis_no,$vehicle_no,$seats,$bus_type,$route,$fare,$arr_time,$dep_time);
        $r=$c2->insert($c1->conn);
         if($r=="error"){
            echo "<script>alert('Error in registration.')</script>";
            die();
            }
         if($r=="done"){
            echo "<script>alert('Bus registration is successful!')</script>";
         }
         }
else if(isset($_POST['post1'])){
    $uname=$_POST['uname'];
    $pwd=$_POST['pwd'];
    header("Location:ticketbook.php");
    
}
else if(isset($_POST['post_ad']) || isset($_POST['post_festival'])){

    $title=$_POST['ad_title'];
    $description=$_POST['ad_description'];
    $redirect_url=$_POST['ad_url'];
    $price=$_POST['price'];
    $image="";
    $category = isset($_POST['post_festival']) ? 'festival' : 'ads';

    if(isset($_FILES['ad_image']) && $_FILES['ad_image']['error']==0){
        $allowed=['jpg','jpeg','png','webp'];
        $ext=strtolower(pathinfo($_FILES['ad_image']['name'], PATHINFO_EXTENSION));

        if(in_array($ext,$allowed)){
            $upload_dir="../images/ads/";
            if(!is_dir($upload_dir)){
                mkdir($upload_dir,0755,true);
            }
            $newname=uniqid('ad_').'.'.$ext;
            $target=$upload_dir.$newname;

            if(move_uploaded_file($_FILES['ad_image']['tmp_name'],$target)){
                $image=$newname;
            }else{
                echo "<script>alert('Failed to upload image.')</script>";
            }
        }else{
            echo "<script>alert('Invalid image format. Use jpg, jpeg, png or webp.')</script>";
        }
    }else{
        echo "<script>alert('Please select an image.')</script>";
    }

    $c1=new dbcon();
    $c2=new Ads($title,$description,$price,$image,$redirect_url,$category);
    $r=$c2->insert($c1->conn);

    if($r=="done"){
        echo "<script>alert('".($category==='festival' ? 'Festival offer' : 'Advertisement')." published successfully!')</script>";
    }else{
        echo "<script>alert('Error while publishing.')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard - Bus Ticket Booking System</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/index.css">
<script src="../javascript/jquery.js"></script>
<script src="../javascript/chart.js"></script>

<style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background: linear-gradient(135deg, #1e3c72, #2a5298);
    color:black;
    overflow-x: hidden;
    overflow-y:auto;
}

.form-panel{
    display:none;
    background:white;
    border-radius:10px;
    padding:25px;
    margin-top:20px;
}

.form-panel.active{
    display:block;
}

.form-panel h2{
    margin-bottom:20px;
    color:#1e3c72;
}

.form-group{
    margin-bottom:15px;
}

.form-group label{
    display:block;
    margin-bottom:6px;
    font-weight:bold;
}

.form-group input,
.form-group textarea{
    width:100%;
    padding:10px;
    border:1px solid #ccc;
    border-radius:5px;
}

.form-row{
    display:flex;
    gap:15px;
}

.form-row .form-col{
    flex:1;
}

.form-panel button[type="submit"]{
    background:#2a5298;
    color:white;
    border:none;
    padding:12px 25px;
    border-radius:5px;
    cursor:pointer;
}

.form-panel button[type="submit"]:hover{
    background:#1e3c72;
}
</style>
<script>

</script>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar1">
    <h2>🚍 Admin Panel</h2>
    <div class="nav-buttons">
        <button class="btn1" >Dashboard</button>
        <button class="btn2" >Active Users</button>
        <button class="btn3" >Buses</button>
        <button class="btn4" onclick="window.location.href='index.php'">Logout</button>
    </div>
</div>

<!-- SIDEBAR -->
<div class="sidebar1">
    <button class="btn6" >Add Bus</button>
    <button class="btn7" >Bookings</button>
    <button class="btn8">Payments</button>
    <button class="btn9">User Registration</button>
    <button class="btn10">Staff Registration</button>
    <button class="btn11">Advertisements</button>
    <button class="btn12">Festival Offer</button>
</div>

<!-- MAIN CONTENT -->
<div class="main container">

    <h2>Dashboard Overview</h2>

    <!-- CARDS -->
   <div class="cards">

    <div class="card">
        <h3>Total Users</h3>
        <p id="total_users">0</p>
    </div>

    <div class="card">
        <h3>Total Buses</h3>
        <p id="total_buses">0</p>
    </div>

    <div class="card">
        <h3>Bookings</h3>
        <p id="total_booking">0</p>
    </div>

    <div class="card">
        <h3>Revenue</h3>
        <p id="revenue">₹0</p>
    </div>

</div>

    <!-- TABLE -->
     <div class="booked" style="display:none;">


     </div>
<script src="../javascript/style.js"> </script>
<script>
function showForm(id){
    document.querySelectorAll('.form-panel').forEach(function(panel){
        panel.classList.remove('active');
    });
    document.getElementById(id).classList.add('active');
}
</script>
</body>
</html>
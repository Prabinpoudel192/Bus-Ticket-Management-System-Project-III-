<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);
include 'db.php';
include 'login.php';
$c1=new dbcon();
if(isset($_POST['post2'])){
    $fname=$_POST['sfname'];
    $mname=$_POST['smname'];
    $lname=$_POST['slname'];
    $address=$_POST['saddress'];
    $email=$_POST['semail'];
    $mobile=$_POST['smobile'];
    $gender=$_POST['sgender'];
    $uname=$_POST['suname'];
    $pwd=$_POST['spwd'];
    $acc=1;
    $status="inactive";
        
        $c2=new login($fname,$mname,$lname,$address,$email,$mobile,$gender,$uname,$pwd,$acc,$status);
        $r=$c2->insert($c1->conn);
         if($r=="duplicate"){
           echo "<script>alert('Email and Mobile must be unique')</script>";
           die();
          }
         if($r=="error"){
            echo "<script>alert('Error in registration.')</script>";
            die();
            }
         if($r=="done"){
            echo "<script>alert('Registration successful! Admin approval required for login.')</script>";
         }
         }
else if(isset($_POST['post1'])){
    $uname=$_POST['uname'];
    $pwd=$_POST['pwd'];
    $sql="select *from login where uname='$uname' and pwd='$pwd' and status='active'";
    $r=$c1->conn->query($sql);
    $row=$r->fetch_assoc();
    if($row && $row['acc']==2){
     $u_id=$row['id'];
     $u_name=$row['uname'];
     $u_mobile=$row['mobile'];

     session_start();
     $_SESSION['u_id'] = $u_id;
     $_SESSION['u_name'] = $u_name;
     $_SESSION['u_mobile'] = $u_mobile;
     
    header("Location:user.php");
    }else if($row && $row['acc']==3){
     $u_id=$row['id'];
     $u_name=$row['uname'];
     $u_mobile=$row['mobile'];

     session_start();
     $_SESSION['u_id'] = $u_id;
     $_SESSION['u_name'] = $u_name;
     $_SESSION['u_mobile'] = $u_mobile;
     
    header("Location:admin.php");
    }else{
         $uname=$_POST['uname'];
         $pwd=$_POST['pwd'];
         $sql="select *from staff where username='$uname' and password='$pwd'";
         $r=$c1->conn->query($sql);
         $row=$r->fetch_assoc();
          if($row && $row['acc']==4){
             $u_id=$row['acc'];
             $u_name=$row['username'];
             $u_mobile=$row['contact'];

              session_start();
              $_SESSION['u_id'] = $u_id;
              $_SESSION['u_name'] = $u_name;
              $_SESSION['u_mobile'] = $u_mobile;
     
              header("Location:staffuser.php");
    }else{
        echo "<script>alert('User Not Found.')</script>";
    }
        }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap-5.3.4-dist/css/bootstrap.min.css">
    <script src="../javascript/jquery.js"></script>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/index1.css">
    <title>Bus Ticket Booking System</title>
</head>
<body>
     <script>
        let visibledisp=false;
        document.addEventListener("mousemove", function () {
            if(!visibledisp){
                document.getElementById("disp").style.display = "block";
                visibledisp=true;
                
               
            }
        });
        
$(document).ready(function(){
$("#bir").on("submit", function(e) {
    e.preventDefault();

    let from = $("input[name='from']").val();
    let to = $("input[name='to']").val();
    let date = $("input[name='date']").val();
    let route=from+"-"+to;
    
    login(route,date);
});
});
       
let images = [
  "../images/ad2.webp",
  "../images/ad3.webp",
  "../images/ad4.jpeg",
   "../images/ad5.avif",
  "../images/ad6.webp",
  "../images/ad7.webp",
  "../images/ad8.webp",
   "../images/ad9.webp",
  "../images/ad10.webp",
  "../images/ad11.webp",
  "../images/ad12.webp"
];

let index = 0;

setInterval(() => {
    index = (index + 1) % images.length;
    document.getElementById("pra1").src = images[(index+11)%images.length];
    }, 10000);
    setInterval(()=>{
      document.getElementById("pra2").src= images[(index+17)%images.length];  
    },13000);
  setInterval(()=>{
    document.getElementById("pra3").src= images[(index+19)%images.length];
  },8000);  
    


</script>

    <!--test page -->
    <!-- ================= HOME / LANDING PAGE ================= -->
<div class="welcome-screen" id="welcome">

    <!-- HERO SECTION -->
    <div class="hero-section">
        <h1>Fast & Reliable Bus Ticket Booking</h1>
        <p>Book your tickets instantly, choose your seat, and travel stress-free.</p>
    </div>
      <!-- ADVERTISEMENT BANNER -->
    <div class="ad-section">
        <div class="ad-card">
        <img id="pra1" src="../images/ad1.webp">
        </div>
        <div class="ad-card">
        <img id="pra2" src="../images/ad5.avif">
        </div>
        <div class="ad-card">
        <img id="pra3" src="../images/ad10.webp">
        </div>
    </div>

    <!-- FEATURES -->
    <div class="features">
        <div class="feature">Individual and Group Ticket Booking</div>
        <div class="feature">Cash and Online Booking</div>
        <div class="feature">Ticket Reservation System</div>
        <div class="feature">Tour and Packages</div>
    </div>

</div>
<!-- ================= HOME END ================= -->


    <!--test page end -->

    <!-- Animated Background -->
    <div class="bg-animation">
        <div class="floating-shape shape-1"></div>
        <div class="floating-shape shape-2"></div>
        <div class="floating-shape shape-3"></div>
        <div class="floating-shape shape-4"></div>
    </div>

    <!-- Navigation Bar -->
    <div class="text-danger bg-info" style="display:none;" id="disp">
        <input type="button" class="btn btn-danger newbtnstyle" value="Login" onclick="login()">
        <input type="button" class="btn btn-primary newbtnstyle" value="Signup" onclick="signup()">
    </div>

    <div class="main-container">
        <!-- Login Form -->
        <div class="form-container" id="pra4">
            <h2 class="form-title icon-login">
                Welcome Back
            </h2>
            <p class="form-subtitle">Sign in to your account</p>
            <form action="" method="post">
                <div class="form-group">
                    <input type="text" class="form-input" placeholder="Username" name="uname" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-input" placeholder="Password" name="pwd" required>
                </div>
                <input type="submit" value="Sign In" name="post1" class="submit-btn">
            </form>
        </div>
     <!-- New Users Registration -->
        <div class="form-container" id="pra5">
            <h2 class="form-title icon-signup">
                Join Us
            </h2>
            <p class="form-subtitle">Create your account</p>
            <form onsubmit="return validation()" action="index.php" method="post">
                <div class="form-group">
                    <input type="text" class="form-input" placeholder="First Name" name="sfname" required>
                    <div id="msg1"></div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-input" placeholder="Middle Name" name="smname">
                    <div id="msg2"></div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-input" placeholder="Last Name" name="slname" required>
                    <div id="msg3"></div>
                </div>
                <div class="form-group">
                    <textarea class="form-input form-textarea" placeholder="Address" name="saddress" required></textarea>
                    <div id="msg5"></div>
                </div>
                <div class="form-group">
                    <input type="email" class="form-input" placeholder="Email" name="semail" required>
                    <div id="msg7"></div>
                </div>
                <div class="form-group">
                    <input type="tel" class="form-input" placeholder="Mobile Number" name="smobile" required>
                    <div id="msg4"></div>
                </div>
                <div class="radio-group gender-group">
                    <span class="radio-group-label">Gender:</span>
                    <div class="radio-item">
                        <input type="radio" name="sgender" value="Male" id="male" required>
                        <label for="male">Male</label>
                    </div>
                    <div class="radio-item">
                        <input type="radio" name="sgender" value="Female" id="female" required>
                        <label for="female">Female</label>
                    </div>
                    <div class="radio-item">
                        <input type="radio" name="sgender" value="Other" id="other" required>
                        <label for="other">Other</label>
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-input" placeholder="Username" name="suname" required>
                    <div id="msg6"></div>
                </div>
                <div class="form-group">
                    <input type="password" class="form-input" placeholder="Password" name="spwd" required>
                    <div id="msg8"></div>
                </div>
                <div class="form-group">
                    <input type="password" class="form-input" placeholder="Confirm Password" name="spwd1" required>
                    <div id="msg9"></div>
                </div>
                <div class="checkbox-group">
                   <input type="checkbox" name="sterms" id="terms" required>I agree to the terms and conditions
                </div>
                <input type="submit" value="Create Account" name="post2" class="submit-btn">
            </form>
        </div>
    <script defer src="../javascript/index.js"></script>
</body>
</html>

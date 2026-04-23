<?php
include 'db.php';
include 'login.php';
if(isset($_POST['post2'])){
    $fname=$_POST['sfname'];
    $mname=$_POST['smname'];
    $lname=$_POST['slname'];
    $address=$_POST['saddress'];
    $email=$_POST['semail'];
    $mobile=$_POST['smobile'];
    $gender=$_POST['sgender'];
    $uname=$_POST['suname'];
    $pwd=$_POST['spwd1'];
    if($c1=new dbcon()){
        $c2=new login($fname,$mname,$lname,$address,$email,$mobile,$gender,$uname,$pwd);
        $r=$c2->insert($c1->conn);
         if($r){
            echo "<script>alert('User registered successfully')</script>";
         }else{
            echo "<script>alert('Erorr in data insertion')</script>";
         }}}
if(isset($_POST['post1'])){
    $uname=$_POST['uname'];
    $pwd=$_POST['pwd'];
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap-5.3.4-dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="../css/index.css">
   <link rel="stylesheet" href="../css/style.css">
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
        </script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color:black;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            overflow: hidden;
            position: relative;
            z-index:0;
        }

         body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image:url("../images/background.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0.2;
            z-index: -1;
        } 
        
        [id^="msg"] {
            font-size: 8px;
            margin-top: 2px;
            display: none;
        }

        .form-container {
            display: none;
        }

        .welcome-screen {
            display: block;
        }
        .checkbox-group  {
          display: inline-flex;   
          align-items: center;
          gap: 4px;  
          margin:0;             
              }

        
       
    </style>

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
        <!-- Welcome Screen -->
        <div class="welcome-screen" id="welcome">
            <h1 class="welcome-title icon-cart">
                Bus Ticket
            </h1>
            <p class="welcome-subtitle">Booking System</p>
             <section class="hero">
    <div class="search-card">
      <h1>Find Your Bus Ticket</h1>

      <div class="inputs">
        <input type="text" placeholder="From (City)">
        <input type="text" placeholder="To (City)">
        <input type="date">
      </div>

      <button onclick="searchBuses()">Search Buses</button>
    </div>
  </section>
        </div>

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

        <!-- Signup Form -->
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
                        <input type="radio" name="sgender" value="m" id="male" required>
                        <label for="male">Male</label>
                    </div>
                    <div class="radio-item">
                        <input type="radio" name="sgender" value="f" id="female" required>
                        <label for="female">Female</label>
                    </div>
                    <div class="radio-item">
                        <input type="radio" name="sgender" value="o" id="other" required>
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

        <!-- Admin Form -->
          <div class="form-container" id="pra10">
            <h2 class="form-title icon-signup">
                Admin Access
            </h2>
            <p class="form-subtitle">Create your Admin account</p>
            <form onsubmit="return validation1()" action="" method="post">
                <div class="form-group">
                    <input type="text" class="form-input" placeholder="First Name" name="afname" required>
                    <div id="msg11"></div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-input" placeholder="Middle Name" name="amname">
                    <div id="msg12"></div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-input" placeholder="Last Name" name="alname" required>
                    <div id="msg13"></div>
                </div>
                <div class="form-group">
                    <textarea class="form-input form-textarea" placeholder="Address" name="aaddress" required></textarea>
                    <div id="msg15"></div>
                </div>
                <div class="form-group">
                    <input type="email" class="form-input" placeholder="Email" name="aemail" required>
                    <div id="msg17"></div>
                </div>
                <div class="form-group">
                    <input type="tel" class="form-input" placeholder="Mobile Number" name="amobile" required>
                    <div id="msg14"></div>
                </div>
                <div class="radio-group gender-group">
                    <span class="radio-group-label">Gender:</span>
                    <div class="radio-item">
                        <input type="radio" name="agender" value="m" id="male" required>
                        <label for="male">Male</label>
                    </div>
                    <div class="radio-item">
                        <input type="radio" name="agender" value="f" id="female" required>
                        <label for="female">Female</label>
                    </div>
                    <div class="radio-item">
                        <input type="radio" name="agender" value="o" id="other" required>
                        <label for="other">Other</label>
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-input" placeholder="Username" name="auname" required>
                    <div id="msg16"></div>
                </div>
                <div class="form-group">
                    <input type="password" class="form-input" placeholder="Password" name="apwd" required>
                    <div id="msg18"></div>
                </div>
                <div class="form-group">
                    <input type="password" class="form-input" placeholder="Confirm Password" name="apwd1" required>
                    <div id="msg19"></div>
                </div>
                <div class="checkbox-group">
                    <input type="checkbox" name="aterms" id="terms" required>
                    <label for="terms">I agree to the terms and conditions</label>
                </div>
                <input type="submit" value="Create Account" name="post3" class="submit-btn">
            </form>
        </div>
      
    <script defer src="../javascript/index.js"></script>
</body>
</html>

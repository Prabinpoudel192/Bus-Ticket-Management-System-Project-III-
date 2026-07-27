<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php';
include 'ads.php';

if(isset($_POST['post_ad'])){
    $title=$_POST['ad_title'];
    $description=$_POST['ad_description'];
    $redirect_url=$_POST['ad_url'];
    $price=$_POST['price'];
    $image="";

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
        echo "<script>alert('Please select an image for the advertisement.')</script>";
    }

    $c1=new dbcon();
    $c2=new Ads($title,$description,$price,$image,$redirect_url,'ads');
    $r=$c2->insert($c1->conn);

    if($r=="done"){
        echo "<script>alert('Advertisement published successfully!')</script>";
    }else{
        echo "<script>alert('Error while publishing advertisement.')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Offer Management</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, Helvetica, sans-serif;
}

body{
    background:#eef2f7;
}

/* Top Navbar */

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

.logo{

    font-size:25px;

    font-weight:bold;

}

.menu{

    display:flex;

    gap:10px;

}

.menu button{

    padding:10px 20px;

    border:none;

    border-radius:6px;

    background:white;

    color:#1e3c72;

    cursor:pointer;

    font-weight:bold;

    transition:.3s;

}

.menu button:hover{

    background:#ffd54f;

}
/* Content */

.container{

    width:90%;

    margin:40px auto;

}

.page{

    display:none;

    background:white;

    border-radius:10px;

    padding:30px;

    min-height:500px;

    box-shadow:0 3px 10px rgba(0,0,0,.15);

}

.page.active{

    display:block;

}

.page h2{

    margin-bottom:20px;

    color:#1e3c72;

}

.container{
    width:95%;
    margin:auto;
}

h1{
    margin-bottom:20px;
    color:#1e3c72;
}

.section{
    background:#fff;
    border-radius:10px;
    padding:20px;
    margin-bottom:25px;
    box-shadow:0 3px 8px rgba(0,0,0,.15);
}

.section h2{
    margin-bottom:20px;
    color:#2a5298;
}

.form-group{
    margin-bottom:15px;
}

label{
    display:block;
    margin-bottom:6px;
    font-weight:bold;
}

input,
textarea,
select{
    width:100%;
    padding:10px;
    border:1px solid #ccc;
    border-radius:5px;
}

textarea{
    resize:vertical;
}

.row{
    display:flex;
    gap:15px;
}

.col{
    flex:1;
}

button{
    background:#2a5298;
    color:white;
    border:none;
    padding:12px 25px;
    border-radius:5px;
    cursor:pointer;
}

button:hover{
    background:#1e3c72;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}

table th,
table td{
    border:1px solid #ddd;
    padding:10px;
    text-align:center;
}

table th{
    background:#2a5298;
    color:white;
}

.action button{
    margin:2px;
}
#ram{
    width:80px;
    height:80px;
    border:none;
    background:none;
    padding:0;
    cursor:pointer;
}

#ram img{
    width:100%;
    height:100%;
    object-fit:contain;
    display:block;
}

</style>

</head>

<body>

<div class="navbar">
<div class="logo">
Offer Management
</div>

<div class="menu">

<button onclick="window.location.href='admin.php'">
Admin Panel
</button>
<button onclick="showPage('discount')">
20% OFF
</button>

<button onclick="showPage('summer')">
Summer Package
</button>

<button onclick="showPage('festival')">
Festival Offer
</button>
<button onclick="showPage('ads')">
Advertisements
</button>

</div>

</div>
<div class="container">

<div class="page<?= isset($_POST['post_ad']) ? '' : ' active' ?>" id="discount">

<h2>20% OFF Offers</h2>

<div class="row">

<div class="col">
<label>Offer Title</label>
<input type="text">
</div>

<div class="col">
<label>Discount (%)</label>
<input type="number">
</div>

</div>

<div class="form-group">
<label>Description</label>
<textarea rows="3"></textarea>
</div>

<div class="row">

<div class="col">
<label>Start Date</label>
<input type="date">
</div>

<div class="col">
<label>End Date</label>
<input type="date">
</div>

<div class="col">
<label>Status</label>

<select>
<option>Active</option>
<option>Inactive</option>
</select>

</div>

</div>

<button>Save Offer</button>

</div>

<div class="page" id="summer">

<h2>Summer Packages</h2>

<input type="text" placeholder="Package Name">

<br><br>

<textarea rows="3" placeholder="Package Description"></textarea>

<br><br>

<div class="row">

<div class="col">
<input type="text" placeholder="Route">
</div>

<div class="col">
<input type="number" placeholder="Price">
</div>

<div class="col">
<input type="file">
</div>

</div>

<br>

<button>Add Summer Package</button>


</div>

<div class="page" id="festival">

<h2>Festival Offers</h2>

<div class="row">

<div class="col">
<input type="text" placeholder="Festival Name">
</div>

<div class="col">
<input type="number" placeholder="Discount">
</div>

</div>

<br>

<textarea rows="3" placeholder="Festival Description"></textarea>

<br><br>

<input type="file">

<br><br>

<button>Save Festival Offer</button>

</div>


<div class="page<?= isset($_POST['post_ad']) ? ' active' : '' ?>" id="ads">

<h2>Advertisements</h2>

<form action="adminuser.php" method="post" enctype="multipart/form-data">

<div class="form-group">
<label>Advertisement Title</label>
<input type="text" name="ad_title" required>
</div>

<div class="form-group">
<label>Advertisement Description</label>
<textarea rows="3" name="ad_description" required></textarea>
</div>

<div class="row">

<div class="col">
<label>Redirect URL</label>
<input type="url" name="ad_url" placeholder="https://example.com" required>
</div>

<div class="col">
<label>Price</label>
<input type="number" name="price" placeholder="Price" required>
</div>

<div class="col">
<label>Ad Image</label>
<input type="file" name="ad_image" accept=".jpg,.jpeg,.png,.webp" required>
</div>

</div>

<br>

<button type="submit" name="post_ad">Publish Advertisement</button>

</form>

</div>

</div>

<script>

function showPage(id){

    let pages=document.querySelectorAll(".page");

    pages.forEach(function(page){

        page.classList.remove("active");

    });

    document.getElementById(id).classList.add("active");

}

</script>
</body>
</html>
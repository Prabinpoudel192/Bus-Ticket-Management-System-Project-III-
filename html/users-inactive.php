<?php
include 'db.php';
class fetchUsers extends dbcon{
function give(){
  $sql="select *from login where status='inactive'";
$r=$this->conn->query($sql);
$data="
<div class='table-box' style='width:100%'>
    
    <h3 style='margin-bottom:10px;' id='tableTitle'>
        Registration Applicant Details
    </h3>

    <table style='width:100%; border-collapse:collapse;'>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Address</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Gender</th>
                <th>User Name</th>
                <th>Password</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>";
   while($row=$r->fetch_assoc()){
    $data.="<tr>
                <td>{$row['fname']}</td>
                <td>{$row['mname']}</td>
                <td>{$row['lname']}</td>
                <td>{$row['address']}</td>
                <td>{$row['email']}</td>
                <td>{$row['mobile']}</td>
                <td>{$row['gender']}</td>
                <td>{$row['uname']}</td>
                <td>{$row['pwd']}</td>
                <td>{$row['status']}</td>
                <td><button class='button' id='approve'>Approve</button><br><br><button class='button' id='delete'>Delete</button></td>
              </tr></tbody>";
    
   }
   $data.="</table>";
    echo $data;
}
}
$c2=new fetchUsers();
$c2->give();
?>

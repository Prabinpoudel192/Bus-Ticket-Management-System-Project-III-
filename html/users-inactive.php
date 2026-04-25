<?php
include 'db.php';
class fetchUsers extends dbcon{
function give(){
  $sql="select *from login where status='inactive'";
$r=$this->conn->query($sql);
$data="";
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

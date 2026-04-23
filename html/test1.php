<?php
$conn=new mysqli("localhost","bus","2232","projectiii") or die("Error in the database connection.");

$sql="select *from login";
$r=$conn->query($sql);
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
              </tr></tbody></table>";
    
   }

    echo $data;





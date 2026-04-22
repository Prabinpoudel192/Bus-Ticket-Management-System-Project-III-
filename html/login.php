<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
class login{
    public $fname,$mname,$lname,$address,$email,$mobile,$gender,$uname,$password;
    function __construct($fname,$mname,$lname,$address,$email,$mobile,$gender,$uname,$password){
       $this->fname=$fname;
       $this->mname=$mname;
       $this->lname=$lname;
       $this->address=$address;
       $this->email=$email;
       $this->mobile=$mobile;
       $this->gender=$gender;
       $this->uname=$uname;
       $this->password=$password;

    }
    function insert($conn){    
        
        $sql="insert into login(fname,mname,lname,address,email,mobile,gender,uname,pwd) values('$this->fname','$this->mname','$this->lname','$this->address','$this->email','$this->mobile','$this->gender','$this->uname','$this->password')";
        $r=$conn->query($sql) or die("Query Error: " . $conn->error);
          
        if($r){
            echo "<script>alert('inserted successfully')</script>";
        }
        else{
            echo "<script>alert('Error in data insertion')</script>";
        }
    }
    }



?>
<?php

class login{
    public $fname,$mname,$lname,$address,$email,$mobile,$gender,$uname,$password,$acc,$status;
    function __construct($fname,$mname,$lname,$address,$email,$mobile,$gender,$uname,$password,$acc,$status){
       $this->fname=$fname;
       $this->mname=$mname;
       $this->lname=$lname;
       $this->address=$address;
       $this->email=$email;
       $this->mobile=$mobile;
       $this->gender=$gender;
       $this->uname=$uname;
       $this->password=$password;
       $this->acc=$acc;
       $this->status=$status;

    }
    function insert($conn){    
        try{
        $sql="insert into login(fname,mname,lname,address,email,mobile,gender,uname,pwd,acc,status) values('$this->fname','$this->mname','$this->lname','$this->address','$this->email','$this->mobile','$this->gender','$this->uname','$this->password','$this->acc','$this->status')";
        $r=$conn->query($sql); 
        return "done";
        }catch(mysqli_sql_exception $e){

        
        if($e->getCode()==1062){
            return "duplicate";
        }
        return "error";
        
        
    }
    }
}


?>
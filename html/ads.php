<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Ads{
    protected $title,$description,$price,$image,$redirect_url,$category;

    function __construct($title,$description,$price,$image,$redirect_url,$category){
        $this->title=$title;
        $this->description=$description;
        $this->price=$price;
        $this->image=$image;
        $this->redirect_url=$redirect_url;
        $this->category=$category;
    }

    function insert($conn){
        try{
            $sql="insert into ads(title,description,price,image,redirect_url,category,status) values('$this->title','$this->description','$this->price','$this->image','$this->redirect_url','$this->category','active')";
            $r=$conn->query($sql);
            return "done";
        }catch(mysqli_sql_exception $e){
            return "error";
        }
    }
}
?>
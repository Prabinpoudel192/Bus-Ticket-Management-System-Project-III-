<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'db.php';

class RateAd extends dbcon{
    public $ad_id,$rating,$user_id;

    function __construct($ad_id,$rating,$user_id){
        parent::__construct();
        $this->ad_id=$ad_id;
        $this->rating=$rating;
        $this->user_id=$user_id;
    }

    function insert(){
        $sql="insert into ad_ratings(ad_id,rating,user_id) values('$this->ad_id','$this->rating','$this->user_id')";
        $r=$this->conn->query($sql);
        if(!$r){
            echo json_encode(["status"=>"error"]);
            return;
        }

        $sql2="select avg(rating) as avg_rating, count(*) as total from ad_ratings where ad_id='$this->ad_id'";
        $r2=$this->conn->query($sql2);
        $row=$r2->fetch_assoc();

        echo json_encode([
            "status"=>"done",
            "avg_rating"=>round($row['avg_rating'],1),
            "total"=>$row['total']
        ]);
    }
}

$ad_id=$_POST['ad_id'];
$rating=$_POST['rating'];
$user_id=$_SESSION['u_id'] ?? null;

$c1=new RateAd($ad_id,$rating,$user_id);
$c1->insert();
?>
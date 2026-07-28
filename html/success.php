<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
echo "<pre>";


include 'db.php';

class confirm extends dbcon {

    function give() {

        if (!isset($_GET['id'])) {
            die("<script>alert('No product id found');</script>");
        }

        $pid = (int)$_GET['id'];

        $sql = "update tickets set status='confirm',payment_method='online' where id='$pid'";
        $r = $this->conn->query($sql);

        if ($r) {
            echo "<script>alert('Ticket has been confirmed');
            window.location.href='user.php';
            </script>";
            
        } else {
            die("<script>alert('Error in the confirmation');</script>");
        }
        }}
$c1 = new confirm();
$c1->give();
?>


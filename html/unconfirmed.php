<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);
include 'db.php';

class del extends dbcon {

function dele(){

$present = time();
$sql = "DELETE FROM tickets WHERE expire < $present";

$r = $this->conn->query($sql);

if (!$r) {
    echo "ERROR"; 
    return;
}

echo "OK";
}
}

$c2 = new del();
$c2->dele();
?>
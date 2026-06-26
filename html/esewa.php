<?php
include 'db.php';

class payTickets extends dbcon {

    function give() {

        if (!isset($_GET['id'])) {
            die("<script>alert('No product id found');</script>");
        }

        $pid = $_GET['id'];

        $sql = "SELECT * FROM tickets WHERE id='$pid'";
        $r = $this->conn->query($sql);

        if ($r->num_rows > 0) {
            return $r->fetch_assoc();
        } else {
            die("<script>alert('No data found');</script>");
        }}}
$c1 = new payTickets();
$data = $c1->give();
$id          = $data['id'];
$name        = $data['name'];
$mobile      = $data['mobile'];
$fare        = $data['fare'];
$total_fare  = $data['total_fare'];
$tax         = $data['tax'];
$total       = $data['total'];
$tranuid = $id . time();
$signed_field_names = "total_amount,transaction_uuid,product_code";
$signature_string = "total_amount={$total},transaction_uuid={$tranuid},product_code=EPAYTEST";
$secret_key = "8gBm/:&EnhH.1/q";
$s = hash_hmac('sha256', $signature_string, $secret_key, true);
$signature = base64_encode($s);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <style>
      #pra15{
      height:auto;
      width:200px;
      margin:100px 0px 0px 400px;
      padding:20px;
      background-color:black;
      border:5px solid black;
       }
      #pra15 form{
       font-size: 25px;
       font-weight:bold;
       border-radius:30px;
       text-align:center;
       background-color:black;
        }
      #pra15 form label{
       font-weight:bold;
       font-size:25px;
       color:white;
        }

    </style>
    <title>Esewa Payment</title>
</head>
<body>
<div id="pra15">
 <form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
 <label>Amount:</label><br><input type="text" id="amount" name="amount" value="<?=$total_fare?>" readonly>
 <label>Tax-Amount:</label><br><input type="text" id="tax_amount" name="tax_amount" value ="<?= $tax ?>" readonly>
 <input type="hidden" id="transaction_uuid" name="transaction_uuid" value="<?= $tranuid?>" readonly>
 <input type="hidden" id="product_code" name="product_code" value ="EPAYTEST" readonly>
 <input type="hidden" id="product_service_charge" name="product_service_charge" value="0" readonly>
 <input type="hidden" id="product_delivery_charge" name="product_delivery_charge" value="0" readonly>
 <label>Tax-Amount:</label><br><input type="text" id="total_amount" name="total_amount" value="<?= $total ?>" readonly>
 <input type="hidden" id="success_url" name="success_url" value="<?= "https://localhost/projectII/Codes/sucess.php?id=$id" ?>" readonly>
 <input type="hidden" id="failure_url" name="failure_url" value="<?= "https://localhost/projectII/Codes/user.php" ?>" readonly>
 <input type="hidden" id="signed_field_names" name="signed_field_names" value="<?= $signed_field_names ?>" readonly>
 <input type="hidden" id="signature" name="signature" value="<?= $signature ?>" readonly>
 <input value="Submit" type="submit" style="border-radius:30px;">
 </form>
</div>
</body>
</html>
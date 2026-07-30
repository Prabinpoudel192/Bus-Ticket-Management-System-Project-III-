<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php';
include 'ads.php';

class festivalform{
function festivalform(){
$data="
<div class='table-box' style='width:35%;'>

    <form action='admin.php' method='post' enctype='multipart/form-data'>

        <div class='form-group'>
            <label>Festival Offer Title</label>
            <input type='text' name='ad_title' required>
        </div>

        <div class='form-group'>
            <label>Festival Offer Description</label>
            <textarea rows='3' name='ad_description' required></textarea>
        </div>

        <div class='form-group'>
            <label>Redirect URL</label>
            <input type='url' name='ad_url' placeholder='https://example.com' required>
        </div>

        <div class='form-group'>
            <label>Price</label>
            <input type='number' name='price' placeholder='Price' required>
        </div>

        <div class='form-group'>
            <label>Offer Image</label>
            <input type='file' name='ad_image' accept='.jpg,.jpeg,.png,.webp' required>
        </div>

        <button type='submit' class='submit-btn' name='post_festival'>Publish Festival Offer</button>

    </form>
</div>";
echo $data;
}
}
$c1=new festivalform();
$c1->festivalform();
?>
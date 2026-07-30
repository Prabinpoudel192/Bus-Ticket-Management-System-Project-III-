<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php';
include 'ads.php';

class adsform{
function adsform(){
$data="
<div class='table-box' style='width:35%;'>

    <form action='admin.php' method='post' enctype='multipart/form-data'>

        <div class='form-group'>
            <label>Advertisement Title</label>
            <input type='text' name='ad_title' required>
        </div>

        <div class='form-group'>
            <label>Advertisement Description</label>
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
            <label>Ad Image</label>
            <input type='file' name='ad_image' accept='.jpg,.jpeg,.png,.webp' required>
        </div>

        <button type='submit' class='submit-btn' name='post_ad'>Publish Advertisement</button>

    </form>
</div>";
echo $data;
}
}
$c1=new adsform();
$c1->adsform();
?>
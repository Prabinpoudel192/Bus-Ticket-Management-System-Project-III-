<?php
$data = '
<div id="bookingFormContainer" style="
    width:400px;
    background:#fff;
    padding:20px;
    border-radius:10px;
">

    <h2 style="margin-bottom:20px;">Book Tour</h2>

    <form id="bookingForm" action="book_ad.php" method="POST">

        <input type="hidden" name="ad_id" id="ad_id">

        <div style="margin-bottom:15px;">
            <label>Full Name</label><br>
            <input type="text" name="name"
                   style="width:100%;padding:10px;"
                   required>
        </div>

        <div style="margin-bottom:15px;">
            <label>Mobile</label><br>
            <input type="text" name="mobile"
                   style="width:100%;padding:10px;"
                   required>
        </div>

        <div style="margin-bottom:15px;">
            <label>Address</label><br>
            <textarea name="address"
                      style="width:100%;padding:10px;"
                      rows="3"
                      required></textarea>
        </div>

        <button type="submit"
                style="
                width:100%;
                padding:12px;
                background:#007bff;
                color:#fff;
                border:none;
                border-radius:5px;
                cursor:pointer;">
            Confirm Booking
        </button>

    </form>

</div>
';

echo $data;
?>
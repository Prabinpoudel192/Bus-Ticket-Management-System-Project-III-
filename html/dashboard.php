<?php

$data="
<div class='table-box' style='width:100%;'>
    
    <h3 style='margin-bottom:10px;' id='tableTitle1'>
        Registration Applicant Details
    </h3>

    <table style='width:100%; border-collapse:collapse;'>
        <thead>
            <tr>
                <th>User</th>
                <th>Bus</th>
                <th>Route</th>
                <th>Seats</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>Prabin</td>
                <td>Express</td>
                <td>KTM → BRT</td>
                <td>3</td>
                <td>Confirmed</td>
            </tr>

            <tr>
                <td>Ram</td>
                <td>Super Fast</td>
                <td>PKR → KTM</td>
                <td>2</td>
                <td>Pending</td>
            </tr>
        </tbody>
    </table>

</div>
";
 
    echo $data;

?>

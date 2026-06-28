<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php';

class fetchBus extends dbcon
{
    function __construct()
    {
        parent::__construct();
    }

    function give()
    {
        $r = $this->conn->query("SELECT * FROM tickets where status='confirm'");

        if ($r->num_rows == 0) {

            echo "<h2 style='color:white; margin:100px 0px 0px 50px;'>
                    No Data to Display
                  </h2>";
            return;
        }
        $sumTotalFare = 0;
        $sumTax = 0;
        $sumTotalAmount = 0;

        $data = "
        <div class='table-box' style='width:100%; overflow:auto;'>

            <h3 style='margin-bottom:10px;' id='tableTitle1'>
                Ticket Booked Details
            </h3>

            <table style='width:100%; border-collapse:collapse;' border='1' cellpadding='8'>
                <thead>
                    <tr>
                        <th>Passenger Name</th>
                        <th>Address</th>
                        <th>Mobile</th>
                        <th>Company Name</th>
                        <th>Route</th>
                        <th>Seats Booked</th>
                        <th>Travel Date</th>
                        <th>Vehicle No</th>
                        <th>Fare</th>
                        <th>Total Fare</th>
                        <th>Tax</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
        ";

        while ($row = $r->fetch_assoc()) {
            $sumTotalFare += $row['total_fare'];
            $sumTax += $row['tax'];
            $sumTotalAmount += $row['total'];

            $data .= "
            <tr>
                <td>{$row['name']}</td>
                <td>{$row['address']}</td>
                <td>{$row['mobile']}</td>
                <td>{$row['company_name']}</td>
                <td>{$row['route']}</td>
                <td>{$row['seat']}</td>
                <td>{$row['travel_date']}</td>
                <td>{$row['veh_no']}</td>
                <td>{$row['fare']}</td>
                <td>{$row['total_fare']}</td>
                <td>{$row['tax']}</td>
                <td>{$row['total']}</td>
                <td>{$row['status']}</td>
            </tr>";
        }
        $data .= "
            <tr style='font-weight:bold; background:#e9ecef;'>
                <td colspan='9' style='text-align:right;'>Grand Total :</td>
                <td>{$sumTotalFare}</td>
                <td>{$sumTax}</td>
                <td>{$sumTotalAmount}</td>
                <td colspan='2'></td>
            </tr>

                </tbody>
            </table>
        </div>";

        echo $data;
    }
}

$c2 = new fetchBus();
$c2->give();
?>
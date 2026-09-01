<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php';
include 'algorithms.php';

class dashboardGraph extends dbcon
{
    function __construct(){
        parent::__construct();
    }

    function getSummary(){
        $summary = [
            'total_tickets' => 0,
            'total_revenue' => 0,
            'total_tax' => 0,
            'confirmed' => 0,
            'pending' => 0
        ];

        $r = $this->conn->query("SELECT status, COUNT(*) as cnt, SUM(total) as amt, SUM(tax) as tx FROM tickets GROUP BY status");
        while($row = $r->fetch_assoc()){
            $summary['total_tickets'] += $row['cnt'];
            $summary['total_revenue'] += $row['amt'];
            $summary['total_tax'] += $row['tx'];
            if($row['status']=='confirm') $summary['confirmed'] = $row['cnt'];
            if($row['status']=='pending') $summary['pending'] = $row['cnt'];
        }
        return $summary;
    }

    function getRevenueByRoute(){
        $data = [];
        $r = $this->conn->query("SELECT route, SUM(total) as revenue FROM tickets WHERE status='confirm' GROUP BY route");
        while($row = $r->fetch_assoc()){
            $data[] = $row;
        }
        $data = quickSort($data, 'revenue', true);//quick sort implemented here
        $data = array_slice($data, 0, 8);
        return $data;
    }

    function getStatusBreakdown(){
        $data = [];
        $r = $this->conn->query("SELECT status, COUNT(*) as cnt FROM tickets GROUP BY status");
        while($row = $r->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
    }
    function getRevenueByDate(){
        $data = [];
        $r = $this->conn->query("SELECT travel_date, SUM(total) as revenue FROM tickets WHERE status='confirm' GROUP BY travel_date ORDER BY travel_date ASC");
        while($row = $r->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
    }
    function give(){
        $summary = $this->getSummary();
        $revenueByRoute = $this->getRevenueByRoute();
        $statusBreakdown = $this->getStatusBreakdown();
        $revenueByDate = $this->getRevenueByDate();

        $routeLabels = json_encode(array_column($revenueByRoute, 'route'));
        $routeValues = json_encode(array_column($revenueByRoute, 'revenue'));

        $statusLabels = json_encode(array_column($statusBreakdown, 'status'));
        $statusValues = json_encode(array_column($statusBreakdown, 'cnt'));

        $dateLabels = json_encode(array_column($revenueByDate, 'travel_date'));
        $dateValues = json_encode(array_column($revenueByDate, 'revenue'));

        $data = "
        <div class='cards'>

            <div class='card'>
                <h3>Total Tickets</h3>
                <p>{$summary['total_tickets']}</p>
            </div>

            <div class='card'>
                <h3>Confirmed</h3>
                <p>{$summary['confirmed']}</p>
            </div>

            <div class='card'>
                <h3>Pending</h3>
                <p>{$summary['pending']}</p>
            </div>

            <div class='card'>
                <h3>Total Revenue</h3>
                <p>Rs. ".number_format($summary['total_revenue'],2)."</p>
            </div>

        </div>

        <div style='display:flex; flex-wrap:wrap; gap:20px; margin-top:20px; background-color:white;'>

            <div class='table-box' style='width:340px;'>
                <h3 style='margin-bottom:10px;'>Revenue by Route</h3>
                <div style='position:relative; height:260px; width:100%;'>
                    <canvas id='routeChart'></canvas>
                </div>
            </div>

            <div class='table-box' style='width:340px;'>
                <h3 style='margin-bottom:10px;'>Booking Status Breakdown</h3>
                <div style='position:relative; height:260px; width:100%;'>
                    <canvas id='statusChart'></canvas>
                </div>
            </div>

        </div>

        <div class='table-box' style='width:100%; margin-top:20px; background-color:white;'>
            <h3 style='margin-bottom:10px;'>Revenue by Booking Date</h3>
            <div style='position:relative; height:280px; width:100%;'>
                <canvas id='dateChart'></canvas>
            </div>
        </div>

        <script>
        (function(){
            var ctx1 = document.getElementById('routeChart').getContext('2d');
            new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: {$routeLabels},
                    datasets: [{
                        label: 'Revenue (Rs)',
                        data: {$routeValues},
                        backgroundColor: '#1565c0',
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive:true,
                    maintainAspectRatio:false,
                    plugins:{ legend:{ display:false } },
                    scales:{
                        x:{ ticks:{ color:'#333' } },
                        y:{ ticks:{ color:'#333' }, beginAtZero:true }
                    }
                }
            });

            var ctx2 = document.getElementById('statusChart').getContext('2d');
            new Chart(ctx2, {
                type: 'pie',
                data: {
                    labels: {$statusLabels},
                    datasets: [{
                        data: {$statusValues},
                        backgroundColor: ['#2e7d32','#ef6c00','#c62828','#6a1b9a','#00838f'],
                        borderColor: '#fff',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive:true,
                    maintainAspectRatio:false,
                    plugins:{
                        legend:{
                            position:'bottom',
                            labels:{ color:'#333' }
                        }
                    }
                }
            });

            var ctx3 = document.getElementById('dateChart').getContext('2d');
            new Chart(ctx3, {
                type: 'line',
                data: {
                    labels: {$dateLabels},
                    datasets: [{
                        label: 'Revenue (Rs)',
                        data: {$dateValues},
                        borderColor: '#1565c0',
                        backgroundColor: 'rgba(21,101,192,0.15)',
                        fill: true,
                        tension: 0.25,
                        pointBackgroundColor: '#1565c0',
                        pointRadius: 4
                    }]
                },
                options: {
                    responsive:true,
                    maintainAspectRatio:false,
                    plugins:{ legend:{ display:false } },
                    scales:{
                        x:{ ticks:{ color:'#333' } },
                        y:{ ticks:{ color:'#333' }, beginAtZero:true }
                    }
                }
            });
        })();
        </script>
        ";

        echo $data;
    }
}

$c = new dashboardGraph();
$c->give();
?>
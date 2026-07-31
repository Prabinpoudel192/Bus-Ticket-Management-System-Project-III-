<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);
include 'db.php';
class fetchBus extends dbcon{
    public $uname,$mobile,$date;
function __construct($uname,$mobile){ 
   parent::__construct();
   $this->uname=$uname;
   $this->mobile=$mobile;
}
function give(){
 $date = date('Y-m-d');
 $result = $this->conn->query("select * from tickets where mobile='$this->mobile' and travel_date>='$date'");

 if(!$result || $result->num_rows == 0){
     $data = '<h2 style=\'color:white; margin:100px 0px 0px 50px;\'>No Ticket has been reserved or confirmed.</h2>';
     echo $data;
     return;
 }

 $gridCards = "";
 $detailCards = "";

 while($login = $result->fetch_assoc()){

     $statusLabel = $login['status']=='pending' ? "Pending Payment" : "Confirmed";
     $statusColor = $login['status']=='pending' ? "#e67e22" : "#27ae60";

     // ---- Compact grid card (summary, click to expand) ----
     $gridCards .= "
<div class='ticket-card' onclick=\"showTicket({$login['id']})\">
    <div class='ticket-card-status' style='background:{$statusColor};'>{$statusLabel}</div>
    <h3>{$login['company_name']}</h3>
    <p class='route'>{$login['route']}</p>
    <p>📅 {$login['travel_date']} &nbsp; 🕒 {$login['travel_time']}</p>
    <p>Seat(s): {$login['seat']}</p>
    <p class='total'>Rs. {$login['total']}</p>
</div>
";

     // ---- Full ticket detail (hidden until clicked) ----
     if($login['status']=='pending'){
        $detailCards .= "
<div id='ticket-{$login['id']}' class='ticket-detail'>
    <button class='back-btn' onclick='backToGrid()'>⬅ Back to My Tickets</button>

    <h2 style='text-align:center; color:#1e3c72;'><b><i>BUS TICKET</i></b></h2>
    <hr>

    <h4 style='color:#c0392b;'><b><i>Passenger Details</i></b></h4>
    <p>Name: <span style='color:#2c3e50;'>{$login['name']}</span></p>
    <p>Address: <span style='color:#2c3e50;'>{$login['address']}</span></p>
    <p>Mobile: <span style='color:#2c3e50;'>{$login['mobile']}</span></p>

    <hr>

    <h4 style='color:#c0392b;'><b><i>Bus Details</i></b></h4>
    <p>Company: <span style='color:#2c3e50;'>{$login['company_name']}</span></p>
    <p>Route: <span style='color:#2c3e50;'>{$login['route']}</span></p>
    <p>Seates Booked: <span style='color:#2c3e50;'>{$login['seat']}</span></p>
    <p>Date: <span style='color:#2c3e50;'>{$login['travel_date']}</span></p>
    <p>Departure Time: <span style='color:#2c3e50;'>{$login['travel_time']}</span></p>
    <p>Vehicle No: <span style='color:#2c3e50;'>{$login['veh_no']}</span> </p>

    <hr>

    <h4 style='color:#c0392b;'><b><i>Fare Summary</i></b></h4>
    <p>Base Fare: Rs. <span id='fare' style='color:#27ae60;'>{$login['total_fare']}</span></p>
    <p>Tax (13%): Rs. <span id='tax' style='color:#e67e22;'>{$login['tax']}</span></p>
    <hr>
    <p><b>Total: Rs. <span id='total' style='color:#27ae60;'>{$login['total']}</span></b></p>

    <hr>

    <div style='text-align:center; margin-top:15px;'>
       <a href='esewa.php?id={$login['id']}'>
        <button>
            Pay via eSewa
        </button>
    </a>
    </div>
</div>
";
        } else if($login['status']=='confirm'){
   $detailCards .= "
<div id='ticket-{$login['id']}' class='ticket-detail'>
    <button class='back-btn' onclick='backToGrid()'>⬅ Back to My Tickets</button>

    <h2 style='text-align:center; font-size:16px; margin:0 0 6px; color:#1e3c72;'><b><i>BUS TICKET</i></b></h2>
    <hr style='margin:6px 0;'>

    <h4 style='margin:6px 0 3px; color:#c0392b;'><b><i>Passenger Details</i></b></h4>
    <p style='margin:2px 0;'>Name: <span style='color:#2c3e50;'>{$login['name']}</span></p>
    <p style='margin:2px 0;'>Address: <span style='color:#2c3e50;'>{$login['address']}</span></p>
    <p style='margin:2px 0;'>Mobile: <span style='color:#2c3e50;'>{$login['mobile']}</span></p>

    <hr style='margin:6px 0;'>

    <h4 style='margin:6px 0 3px; color:#c0392b;'><b><i>Bus Details</i></b></h4>
    <p style='margin:2px 0;'>Company: <span style='color:#2c3e50;'>{$login['company_name']}</span></p>
    <p style='margin:2px 0;'>Route: <span style='color:#2c3e50;'>{$login['route']}</span></p>
    <p style='margin:2px 0;'>Seates Booked: <span style='color:#2c3e50;'>{$login['seat']}</span></p>
    <p style='margin:2px 0;'>Date: <span style='color:#2c3e50;'>{$login['travel_date']}</span></p>
    <p style='margin:2px 0;'>Departure Time: <span style='color:#2c3e50;'>{$login['travel_time']}</span></p>
    <p style='margin:2px 0;'>Vehicle No: <span style='color:#2c3e50;'>{$login['veh_no']}</span> </p>

    <hr style='margin:6px 0;'>

    <h4 style='margin:6px 0 3px; color:#c0392b;'><b><i>Fare Summary</i></b></h4>
    <p style='margin:2px 0;'>Base Fare: Rs. <span id='fare' style='color:#27ae60;'>{$login['total_fare']}</span></p>
    <p style='margin:2px 0;'>Tax (13%): Rs. <span id='tax' style='color:#e67e22;'>{$login['tax']}</span></p>
    <hr style='margin:6px 0;'>
    <p style='margin:2px 0;'><b>Total: Rs. <span id='total' style='color:#27ae60;'>{$login['total']}</span></b></p>

    <hr style='margin:6px 0;'>

    <div style='text-align:center; margin-top:10px;'>
       <button onclick='printTicket({$login['id']})'>🖨️ Print</button>
       <button onclick='resetApp()'>🔄 New Booking</button>
    </div>
</div>
";
}
 }

 $data = "
<style>
#ticketsGrid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(240px,1fr));
    gap:16px;
    padding:20px;
    max-height:70vh;
    overflow-y:auto;
}

.ticket-card{
    background:#fff;
    border-radius:10px;
    padding:14px;
    cursor:pointer;
    box-shadow:0 3px 10px rgba(0,0,0,.15);
    transition:transform .15s ease;
    position:relative;
}

.ticket-card:hover{
    transform:translateY(-3px);
}

.ticket-card h3{
    color:#1e3c72;
    margin:6px 0 4px;
    font-size:16px;
}

.ticket-card .route{
    font-weight:bold;
    color:#2c3e50;
    margin-bottom:4px;
}

.ticket-card p{
    font-size:13px;
    color:#444;
    margin:2px 0;
}

.ticket-card .total{
    font-weight:bold;
    color:#27ae60;
    margin-top:6px;
}

.ticket-card-status{
    display:inline-block;
    color:#fff;
    font-size:11px;
    padding:3px 8px;
    border-radius:12px;
    margin-bottom:6px;
}

.ticket-detail{
    display:none;
    width:420px;
    max-height:80vh;
    overflow-y:auto;
    margin:20px auto;
    padding:20px;
    border:2px dashed #333;
    font-family:Arial;
    background:#fff;
}

.back-btn{
    display:block;
    margin-bottom:15px;
    padding:8px 14px;
    border:none;
    border-radius:6px;
    background:#1e3c72;
    color:#fff;
    cursor:pointer;
}
</style>

<div id='ticketsGrid'>
{$gridCards}
</div>

{$detailCards}

<script>
function showTicket(id){
    document.getElementById('ticketsGrid').style.display = 'none';

    document.querySelectorAll('.ticket-detail').forEach(function(el){
        el.style.display = 'none';
    });

    var target = document.getElementById('ticket-' + id);
    if(target){
        target.style.display = 'block';
    }
}

function backToGrid(){
    document.querySelectorAll('.ticket-detail').forEach(function(el){
        el.style.display = 'none';
    });
    document.getElementById('ticketsGrid').style.display = 'grid';
}
</script>
";

 echo $data;
}
}

$uname=$_POST['uname'];
$mobile=$_POST['mobile'];
$c2=new fetchBus($uname,$mobile);
$c2->give();
?>
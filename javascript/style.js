let selectedSeats = [];
let tempBooked=[];
let bookedSeats = []; 
let vehno="";
function selectBus(name) {
  alert("Selected Bus: " + name + " (Seat module will come next)");
}


   function goToBooking() {
      window.location.href = "booking.html";
    }

    function logout() {
      window.location.href = "index.html";
    }
    function showPage(pageId,seats=0,vehicleno="null",date="null") {
      document.querySelectorAll(".page").forEach(p => p.classList.remove("active"));
      document.querySelector(".display").innerHTML = ""; 
      document.querySelector(".display").style.display = "none";
      if(pageId==="passenger" || pageId==="ticket"){
      document.getElementById(pageId).classList.add("active");
      }
      else if(pageId==="booking" && seats>0){
      document.getElementById(pageId).classList.add("active");
      selectedSeats = [];
      vehno=vehicleno;
      $.ajax({
            url:"reserve.php",
            type: "POST",
             data: {
            vehno: vehno,
            date:date,
            
        },
            dataType:"json",
            success: function(data){
              console.log(data);
                tempBooked = [...new Set(
        data.pending
            .flatMap(item => item.seat.split(','))
            .map(seat => seat.trim())
    )];

    bookedSeats = [...new Set(
        data.confirmed
            .flatMap(item => item.seat.split(','))
            .map(seat => seat.trim())
    )];
             createSeats();
            },
            error: function(){
                $(".display").html("Error loading data");
           }
        });
      }
function createSeats(){

let total=seats;

const bus = document.getElementById("bus");
bus.innerHTML="";
let table = document.createElement("table");


// Header
table.innerHTML = `
  <thead>
    <tr>
      <th colspan="2">Side A</th>
      <th class="mid"></th>
      <th colspan="2">Side B</th>
    </tr>
  </thead>
`;

let tbody = document.createElement("tbody");

for (let i = 1; i <= total; i += 4) {
  let row = document.createElement("tr");

  for (let j = 0; j < 4; j++) {
    if (j === 2) {
      let aisle = document.createElement("td");
      aisle.innerHTML = "&nbsp;";
      row.appendChild(aisle);
    }

    let seatNum = i + j;
    if (seatNum > total) break;

    let td = document.createElement("td");
    let button = document.createElement("button");

    button.id = "btn" + seatNum;
    button.innerText = seatNum;
    button.classList.add("button");

    const num = seatNum.toString();

    if (bookedSeats.includes(num)) {
      button.classList.add("booked");
      button.disabled = true;
    }else if(tempBooked.includes(String(num))){
      button.classList.toggle("selected");
      button.disabled=true;
    }
     else {
      button.onclick = function () {
        button.classList.toggle("selected");

        if (selectedSeats.includes(num)) {
          selectedSeats = selectedSeats.filter(s => s !== num);
        } else {
          selectedSeats.push(num);
        }
      };
    }

    td.appendChild(button);
    row.appendChild(td);
  }
  
  tbody.appendChild(row);
}

table.appendChild(tbody);
bus.appendChild(table);
tempBooked=[];
bookedSeats=[];
      }}
function goToPassenger() {
  if (selectedSeats.length === 0) {
    alert("Select at least one seat!");
    return;
  }
  showPage("passenger");
}
//Ticket booking whole javascript start here
function generateTicket(route,date,id,uname,exptime) {
  let veh=vehno;
  vehno="";
  document.getElementById("ticketDetails").innerHTML = `
    <b>Seats:</b> ${selectedSeats.join(", ")}
    <b>Route:</b>${route}<br>
    <b>Date:</b>${date}<br>
    <b>Vehicle NO:</b>${veh}<br>

  `;
     $(document).ready(function(){
    function loadData(url){
        $(".display").show().html("Loading...");

        $.ajax({
            url: url,
            type: "POST",
             data: {
            route: route,
            date: date,
            id:id,
            uname:uname,
            veh:veh,
            seat:selectedSeats,
            exp:exptime

        },
            success: function(data){
               $(".display").html(data);
            },
            error: function(){
                $(".display").html("Error loading data");
                 showPage("ticket");
            }
        });
    
      }
    
        loadData("ticketbook2.php");
});

}
//Ticket  booking whole js ends here

function resetApp() {
  location.reload();
}
  
//admin.php page whole javascript
$(document).ready(function(){
    function loadData(url){
        $(".booked").show().html("Loading...");

        $.ajax({
            url: url,
            type: "POST",
            success: function(data){
                $(".booked").html(data);
            },
            error: function(){
                $(".booked").html("Error loading data");
            }
        });
    
      }
    
    $(".btn1").click(function(){
        loadData("dashboard.php");
    });
    $(".btn1").click();
    $(".btn2").click(function(){
        loadData("users-active.php");
    });

    $(".btn9").click(function(){
        loadData("users-inactive.php");
    });
    $(".btn6").click(function(){
      loadData("addbus.php");
   });
    $(".btn3").click(function(){
      loadData("bustable.php")
    });
     $(".btn7").click(function(){
      loadData("booking.php")
    });



function dataSets(){
    $.ajax({
            url: "admindata.php",
            type: "POST",
            dataType:"json",
            success: function(data){
               $("#total_users").text(data.total_users);
               $("#total_buses").text(data.total_buses);
               $("#total_booking").text(data.total_booking);
               $("#revenue").text("₹ " + data.revenue);   
            },
            error: function(){
                $(".cards").html("Error loading data");
                
            }
        });
    
      }
    
        dataSets();
});
function doThis(){
    window.location.href="adminuser.php";
}
//admin.php javascript ends here


//ticketbook.php all javascript
function bookfunc(route,date){
 $(document).ready(function(){
    function loadData(url, title){
        $(".display").show().html("Loading...");

        $.ajax({
            url: url,
            type: "POST",
             data: {
            route: route,
            date: date
        },
            success: function(data){
               $("#tableTitle").text(title);
               $(".display").html(data);
            },
            error: function(){
                $(".display").html("Error loading data");
            }
        });
    
      }
    
        loadData("ticketbook1.php", "Available Buses");
});
}
function unconfirmed(){
        $.ajax({
            url: "unconfirmed.php",
            type: "POST",
            success:function(data){
             //alert(data);
            }
        });
      }
      setInterval(unconfirmed,20000);



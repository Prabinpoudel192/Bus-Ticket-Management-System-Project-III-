let selectedSeats = [];
let bookedSeats = ["3", "7"]; 
let vehno="";

/* function searchBuses() {
  const results = document.getElementById("results");
  results.innerHTML = "";

  const dummyBuses = [
    { name: "Express Deluxe", from: "Kathmandu", to: "Bharatpur", time: "10:00 AM", price: 800 },
    { name: "Super Fast", from: "Pokhara", to: "Chitwan", time: "2:00 PM", price: 950 },
    { name: "Night Rider", from: "Butwal", to: "Kathmandu", time: "9:00 PM", price: 1200 }
  ];

  dummyBuses.forEach(bus => {
    const card = document.createElement("div");
    card.className = "card";

    card.innerHTML = `
      <h3>${bus.name}</h3>
      <p>${bus.from} → ${bus.to}</p>
      <p>Departure: ${bus.time}</p>
      <p>Price: Rs ${bus.price}</p>
      <button class="book-btn" onclick="selectBus('${bus.name}')">View Seats</button>
    `;

    results.appendChild(card);
  });
}*/

function selectBus(name) {
  alert("Selected Bus: " + name + " (Seat module will come next)");
}


   function goToBooking() {
      window.location.href = "booking.html";
    }

    function logout() {
      window.location.href = "index.html";
    }
    function showPage(pageId,seats=0,vehicleno="null") {
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


let total=seats;

const bus = document.getElementById("bus");
bus.innerHTML="";
let table = document.createElement("table");


// Header
table.innerHTML = `
  <thead>
    <tr>
      <th>Side A</th>
      <th>Side B</th>
    </tr>
  </thead>
`;

let tbody = document.createElement("tbody");

for (let i = 1; i <= total; i += 2) {
  let row = document.createElement("tr");

  for (let j = 0; j < 2; j++) {
    let seatNum = i + j;
    if (seatNum > total) break;

    let td = document.createElement("td");
    let button = document.createElement("button");

    button.id = "btn" + seatNum;
    button.innerText = seatNum;

    if (bookedSeats.includes(seatNum.toString())) {
      button.classList.add("booked");
      button.disabled = true;
    } else {
      button.onclick = function () {
        button.classList.toggle("selected");

        let num = seatNum.toString();

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
      }}
function goToPassenger() {
  if (selectedSeats.length === 0) {
    alert("Select at least one seat!");
    return;
  }
  showPage("passenger");
}
//Ticket booking whole javascript start here
function generateTicket(route,date,time,id,uname) {
  let veh=vehno;
  vehno="";
  document.getElementById("ticketDetails").innerHTML = `
    <b>Seats:</b> ${selectedSeats.join(", ")}
    <b>Route:</b>${route}<br>
    <b>Date:</b>${date}<br>
    <b>Time:</b>${time}<br>
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
            time: time,
            id:id,
            uname:uname,
            veh:veh,
            seat:selectedSeats
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
  
//Admin.php page javascript
function adminfunc(){
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

});
}

//ticketbook.php all javascript
function bookfunc(route,date,time){
 $(document).ready(function(){
    function loadData(url, title){
        $(".display").show().html("Loading...");

        $.ajax({
            url: url,
            type: "POST",
             data: {
            route: route,
            date: date,
            time: time
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

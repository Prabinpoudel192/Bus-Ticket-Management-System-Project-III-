function searchBuses() {
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
}

function selectBus(name) {
  alert("Selected Bus: " + name + " (Seat module will come next)");
}


   function goToBooking() {
      window.location.href = "booking.html";
    }

    function logout() {
      window.location.href = "index.html";
    }
    function showPage(pageId) {
  document.querySelectorAll(".page").forEach(p => p.classList.remove("active"));
  document.getElementById(pageId).classList.add("active");
}


let selectedSeats = [];
let bookedSeats = ["3", "7"]; 
let total=30;

const bus = document.getElementById("bus");

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
function goToPassenger() {
  if (selectedSeats.length === 0) {
    alert("Select at least one seat!");
    return;
  }
  showPage("passenger");
}
function generateTicket() {
  let name = document.getElementById("name").value;
  let age = document.getElementById("age").value;

  if (!name || !age) {
    alert("Fill all details!");
    return;
  }
  document.getElementById("ticketDetails").innerHTML = `
    <b>Name:</b> ${name} <br>
    <b>Age:</b> ${age} <br>
    <b>Seats:</b> ${selectedSeats.join(", ")}
  `;

  showPage("ticket");
}
function resetApp() {
  location.reload();
}
//Admin.php page javascript
function tabledisplay{
  $(document).ready(function(){
    $(".btn1").click(function(){
    $(".booked").css("display","block");
    $.ajax({
        url:"dashboard.php",
        type:"POST",
        
        success:function(data){
        
        $("#tableTitle").text("Booking Details");
                $(".booked").html(data);
        }
    });
    });
});
$(document).ready(function(){
    $(".btn9").click(function(){
    $(".booked").css("display","block");
    $.ajax({
        url:"users-inactive.php",
        type:"POST",
        
        success:function(data){
        
        $("#tableTitle").text("Booking Details");
                $(".booked").html(data);
        }
    });
    });
});
$(document).ready(function(){
    $(".btn2").click(function(){
    $(".booked").css("display","block");
    $.ajax({
        url:"users-active.php",
        type:"POST",
        
        success:function(data){
        
        $("#tableTitle").text("Booking Details");
                $(".booked").html(data);
        }
    });
    });
});

}
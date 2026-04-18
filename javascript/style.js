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

function raja(){
  alert("You have been pawned.")
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

const bus = document.getElementById("bus");

for (let i = 1; i <= 12; i++) {
  let seat = document.createElement("div");
  seat.classList.add("seat");
  seat.innerText = i;

  if (bookedSeats.includes(i.toString())) {
    seat.classList.add("booked");
  } else {
    seat.onclick = function () {
      seat.classList.toggle("selected");

      let num = seat.innerText;

      if (selectedSeats.includes(num)) {
        selectedSeats = selectedSeats.filter(s => s !== num);
      } else {
        selectedSeats.push(num);
      }
    };
  }
  bus.appendChild(seat);
}
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
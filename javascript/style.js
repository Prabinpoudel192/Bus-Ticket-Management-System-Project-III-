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
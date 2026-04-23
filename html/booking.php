<?php
echo "<script>alert('i am here')</script>"
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Booking Page</title>

<style>
body {
  font-family: Arial, sans-serif;
  background: #f4f4f4;
  text-align: center;
  margin: 0;
}
</style>

</head>
<body>

<h1>🚌 Select Your Seats</h1>

<!-- Legend -->
<div class="legend">
  <span><div class="box" style="background:#ccc;"></div> Available</span>
  <span><div class="box" style="background:green;"></div> Selected</span>
  <span><div class="box" style="background:red;"></div> Booked</span>
</div>

<!-- Seat Layout -->
<div class="bus" id="bus"></div>

<button onclick="proceed()">Continue</button>

<script>
// Demo booked seats
let bookedSeats = ["2", "5", "9"];
let selectedSeats = [];

const bus = document.getElementById("bus");

// Generate seats
for (let i = 1; i <= 16; i++) {
  let seat = document.createElement("div");
  seat.classList.add("seat");
  seat.innerText = i;

  // If already booked
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

// Continue button
function proceed() {
  if (selectedSeats.length === 0) {
    alert("Please select at least one seat!");
    return;
  }

  // Store seats (for next page)
  localStorage.setItem("selectedSeats", JSON.stringify(selectedSeats));

  // Redirect
  window.location.href = "passenger.html";
}
</script>

</body>
</html>
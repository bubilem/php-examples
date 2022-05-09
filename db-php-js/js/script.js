console.log("Hello");
const flightsEle = document.getElementById("flights");
const xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function () {
  if (this.readyState == 4 && this.status == 200) {
    let data = JSON.parse(xhttp.responseText);
    flightsEle.innerHTML = "";
    for (let flight of data) {
      let flightEle = document.createElement("tr");
      flightEle.innerHTML = `
        <td>${flight.type}</td>
        <td>${flight.dttm}</td>
        <td>${flight.destination}</td>
      `;
      flightsEle.appendChild(flightEle);
    }
  }
};

function refresh() {
  xhttp.open("GET", "flights.php", true);
  xhttp.send();
}
refresh();
setInterval(refresh, 10000);

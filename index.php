<!DOCTYPE html>
<html>
<body onload="getLocation()">
<script src="./js/jquery.min.js"></script>
<script src="./js/jstz.min.js"></script>

<p id="demo"></p>
<embed><time id="date"></time></embed>
<div id="ip"></div>
<script>
var x = document.getElementById("demo");

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition, showError);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  fetch('https://ipapi.co/json/')
  .then(data => data.json())
  .then(data => {$('#ip').html(data.ip);});

  const xhttp = new XMLHttpRequest();
xhttp.open("GET", "form.php?lat=" + position.coords.latitude + "&lon=" + position.coords.longitude + "&loc=" + loc + "&date=" + date + "&ip=" , true);
xhttp.send();

  x.innerHTML = "Latitude: " + position.coords.latitude + 
  "<br>Longitude: " + position.coords.longitude;
}

function showError(error) {
  switch(error.code) {
    case error.PERMISSION_DENIED:
      x.innerHTML = "User denied the request for Geolocation."
      break;
    case error.POSITION_UNAVAILABLE:
      x.innerHTML = "Location information is unavailable."
      break;
    case error.TIMEOUT:
      x.innerHTML = "The request to get user location timed out."
      break;
    case error.UNKNOWN_ERROR:
      x.innerHTML = "An unknown error occurred."
      break;
  }
}

var tz = jstz.determine();
var loc = tz.name();
var date = new Date($.now());

$("embed").replaceWith(loc);
$("#date").replaceWith(date);
</script>

</body>
</html>
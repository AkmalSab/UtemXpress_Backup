<!DOCTYPE html>
<html lang="en">
<head>
    <x-head-component/>
    <title>Route Maps</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <style>
        /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
        #map {
            height: 100%;
        }

        /* Optional: Makes the sample page fill the window. */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        #floating-panel {
            position: absolute;
            top: auto;
            left: 25%;
            z-index: 5;
            background-color: #fff;
            padding: 5px;
            border: 1px solid #999;
            text-align: center;
            font-family: "Roboto", "sans-serif";
            line-height: 30px;
            padding-left: 10px;
        }
    </style>
</head>
<body>
<x-header-component/>
<div id="floating-panel">
    <a class="btn btn-primary" href="{{ url()->previous() }}">Go Back</a>
    <b>Mode of Travel: </b>
    <select id="mode">
        <option value="DRIVING">Driving</option>
        <option value="WALKING">Walking</option>
        <option value="BICYCLING">Bicycling</option>
        <option value="TRANSIT">Transit</option>
    </select>
</div>
<div class="container" id="map"></div>
<!-- Async script executes immediately and must be after any DOM elements used in callback. -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCD_MzxRlzk37ggGXXy2zOV8noROMoqDjI&callback=initMap&libraries=geometry&v=weekly" async></script>
<script>

    var details = @json($OrderDetails);
    var startLat = Number(details.pickup_location_latitude);
    var startLon = Number(details.pickup_location_longitude);
    var endLat = Number(details.dropoff_location_latitude);
    var endLon = Number(details.dropoff_location_longitude);

    function initMap() {
        const directionsRenderer = new google.maps.DirectionsRenderer();
        const directionsService = new google.maps.DirectionsService();
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 14,
            center: { lat: startLon, lng: startLat },
        });
        directionsRenderer.setMap(map);
        calculateAndDisplayRoute(directionsService, directionsRenderer);
        getDistanceAndDuration();
        document.getElementById("mode").addEventListener("change", () => {
            calculateAndDisplayRoute(directionsService, directionsRenderer);
        });
    }

    function calculateAndDisplayRoute(directionsService, directionsRenderer) {
        const selectedMode = document.getElementById("mode").value;
        directionsService.route(
            {
                origin: { lat: startLon, lng: startLat},
                destination: { lat: endLon, lng:  endLat},
                // Note that Javascript allows us to access the constant
                // using square brackets and a string value as its
                // "property."
                travelMode: google.maps.TravelMode[selectedMode],
            },
            (response, status) => {
                if (status == "OK") {
                    directionsRenderer.setDirections(response);
                } else {
                    window.alert("Directions request failed due to " + status);
                }
            }
        );
    }

    function getDistanceAndDuration() {
        // initialize services
        const geocoder = new google.maps.Geocoder();
        const service = new google.maps.DistanceMatrixService();
        // build request
        const origin1 = {lat: startLon, lng: startLat};
        const destinationB = {lat: endLon, lng: endLat};
        const request = {
            origins: [origin1],
            destinations: [destinationB],
            travelMode: google.maps.TravelMode.DRIVING,
            unitSystem: google.maps.UnitSystem.METRIC,
            avoidHighways: false,
            avoidTolls: false,
        };
        // get distance matrix response
        service.getDistanceMatrix(request).then((response) => {
            console.log(response.rows[0].elements[0].distance.text);
            console.log(response.rows[0].elements[0].duration.text);
        });
    }

</script>
</body>
</html>

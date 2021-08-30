<!DOCTYPE html>
<html>
<head>
    <title>Distance Matrix Service</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <!-- jsFiddle will insert css and js -->
    <style>
        /* Optional: Makes the sample page fill the window. */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        #container {
            height: 100%;
            display: flex;
        }

        #sidebar {
            flex-basis: 15rem;
            flex-grow: 1;
            padding: 1rem;
            max-width: 30rem;
            height: 100%;
            box-sizing: border-box;
            display: flex;
            overflow: auto;
        }

        #map {
            flex-basis: 0;
            flex-grow: 4;
            height: 100%;
        }

        #sidebar {
            flex-direction: column;
        }
    </style>
</head>
<body>
<div id="container">
    <div id="map"></div>
    <div id="sidebar">
        <h3 style="flex-grow: 0">Request</h3>
        <pre style="flex-grow: 1" id="request"></pre>
        <h3 style="flex-grow: 0">Response</h3>
        <pre style="flex-grow: 1" id="response"></pre>
    </div>
</div>

<!-- Async script executes immediately and must be after any DOM elements used in callback. -->
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCD_MzxRlzk37ggGXXy2zOV8noROMoqDjI&callback=initMap&libraries=&v=weekly"
    async
></script>
<script>
    function getDistanceAndDuration() {
        // initialize services
        const geocoder = new google.maps.Geocoder();
        const service = new google.maps.DistanceMatrixService();
        // build request
        const origin1 = { lat: 2.30814, lng: 102.319239 };
        const destinationB = { lat: 2.321104099999999, lng: 102.3282899 };
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
            // put response
            document.getElementById("response").innerText = JSON.stringify(response,null,2);
            console.log(response.rows[0].elements[0].distance.text);
            console.log(response.rows[0].elements[0].duration.text);
        });
    }

</script>
</body>
</html>

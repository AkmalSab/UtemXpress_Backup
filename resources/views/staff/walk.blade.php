{{--walk form--}}
<div class="container" id="walk-form">
    <form method="POST" action="{{url('/staff/createOrderWalk')}}">
        @csrf
        <h2>Walking / Bicycle</h2>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Pick Up Location</label>
            <input type="text" class="form-control" id="pickUpLocation" name="pickUpLocation" required>
            <input type="hidden" class="form-control" id="latitudePickup" name="latitudePickup" required>
            <input type="hidden" class="form-control" id="longitudePickup" name="longitudePickup" required>
            <div class="form-text">Location you would like runner to pick up the parcel</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Drop Off Location</label>
            <input type="text" class="form-control" id="dropOffLocation" name="dropOffLocation" required>
            <input type="hidden" class="form-control" id="latitudeDropOff" name="latitudeDropOff" required>
            <input type="hidden" class="form-control" id="longitudeDropOff" name="longitudeDropOff" required>
            <div class="form-text">Location you would like runner to submit the parcel</div>
        </div>
        <hr style="background-color:blue;height:3px;">
        <h5>Additional Services</h5>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="XpressBag" name="XpressBag">
            <label class="form-check-label" for="exampleCheck1">Xpress Bag</label>
            <i class="fa fa-briefcase" aria-hidden="true"></i>
            <b class="float-end">(+RM 0)</b>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="BuyForYou" name="BuyForYou">
            <label class="form-check-label" for="exampleCheck1">Buy For You</label>
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            <b class="float-end">(+RM 4)</b>
        </div>
        <hr>
        <h5>Subtotal</h5>
        <div class="mb-3 form-check">
            <label class="form-check-label" for="exampleCheck1">Base Price: </label>
            <i class="fas fa-money-bill-wave"></i>
            <b class="float-end">RM 4</b>
        </div>
        <div class="mb-3 form-check">
            <label class="form-check-label" for="exampleCheck1">Distance</label>
            <i class="fa fa-location-arrow" aria-hidden="true"></i> (RM0.50 for each 1KM)
            <b class="float-end"><b id="finalDistance"></b></b>
        </div>
        <h2>Order Price: RM <b id="orderFinalPrice"></b></h2>
        <input type="hidden" class="form-control" id="orderFinalPrice2" name="orderFinalPrice2" required>
        <input type="hidden" class="form-control" id="finalDistanceVal" name="finalDistanceVal" required>
        <div class="form-group mb-3">
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <input type="submit" class="btn btn-primary col-12 mb-3" name="dn" value="Deliver Now">
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <input type="submit" class="btn btn-warning col-12 mb-3" name="ofl" value="Scheduled For Later">
                </div>
            </div>
        </div>
    </form>
</div>
<script>

    const xb = document.getElementById('XpressBag');
    const b4u = document.getElementById('BuyForYou');

    var ofp = document.getElementById('orderFinalPrice');
    var ofp2 = document.getElementById('orderFinalPrice2');
    var ofp3 = document.getElementById('orderFinalPrice3');
    var dis = document.getElementById('finalDistanceVal');
    var dis2 = document.getElementById('finalDistance');

    ofp2.value = 4;
    ofp.innerHTML = '4';
    dis2.innerHTML = '0 KM';
    dis.value = 0;

    google.maps.event.addDomListener(window, 'load', initialize);

    function initialize() {
        var latitudePickup = document.getElementById('latitudePickup').value;
        var longitudePickup = document.getElementById('longitudePickup').value;
        var latitudeDropOff = document.getElementById('latitudeDropOff').value;
        var longitudeDropOff = document.getElementById('longitudeDropOff').value;

        var options = {
            componentRestrictions: {
                country: "MY"
            }
        };

        var pickUpLocation = document.getElementById('pickUpLocation');
        var dropOffLocation = document.getElementById('dropOffLocation');

        var autocomplete = new google.maps.places.Autocomplete(pickUpLocation, options);
        var autocomplete2 = new google.maps.places.Autocomplete(dropOffLocation,options);

        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            //console.log(place)
            $('#latitudePickup').val(place.geometry['location'].lng());
            $('#longitudePickup').val(place.geometry['location'].lat());

            latitudePickup = $('#latitudePickup').val();
            longitudePickup = $('#longitudePickup').val();

        });

        autocomplete2.addListener('place_changed', function() {
            var place = autocomplete2.getPlace();
            //console.log(place)
            $('#latitudeDropOff').val(place.geometry['location'].lng());
            $('#longitudeDropOff').val(place.geometry['location'].lat());

            latitudeDropOff = $('#latitudeDropOff').val();
            longitudeDropOff = $('#longitudeDropOff').val();

            getDistance();
        });

        b4u.addEventListener('change', (event) => {
            console.log(b4u.checked);
            if(b4u.checked) {
                ofp2.value = (parseFloat(ofp2.value) + 4).toFixed(2);
                // console.log('nilai selepas ditambah' + ofp2.value);
                ofp.innerHTML = ofp2.value;
            }
            if(!b4u.checked) {
                ofp2.value = (parseFloat(ofp2.value) - 4).toFixed(2);
                // console.log('nilai selepas ditolak' + ofp2.value);
                ofp.innerHTML = ofp2.value;
            }
        });

        function getDistance(){
            // initialize services
            const geocoder = new google.maps.Geocoder();
            const service = new google.maps.DistanceMatrixService();
            // build request
            const origin1 = { lat: parseFloat(longitudePickup), lng: parseFloat(latitudePickup) };
            const destinationA = { lat: parseFloat(longitudeDropOff), lng: parseFloat(latitudeDropOff) };
            const request = {
                origins: [origin1],
                destinations: [destinationA],
                travelMode: google.maps.TravelMode.WALKING,
                unitSystem: google.maps.UnitSystem.METRIC,
                avoidHighways: false,
                avoidTolls: false,
            };
            // get distance matrix response
            service.getDistanceMatrix(request).then((response) => {
                dis2.innerHTML = response.rows[0].elements[0].distance.text.toUpperCase();
                var ret = response.rows[0].elements[0].distance.text.replace(' km','');
                dis.value = parseFloat(ret);

                var a = parseFloat(ofp2.value) + (parseFloat(dis.value) * 0.5);
                var b = parseFloat(dis.value) * 0.5;
                ofp2.value = a.toFixed(2);
                ofp.innerHTML = a.toFixed(2);
                dis.value = b.toFixed(2);
                dis2.innerHTML += ' (+RM ' + b.toFixed(2) + ')';
            });
        }
    }
</script>
{{--walk form--}}

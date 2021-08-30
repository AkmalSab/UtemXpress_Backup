{{--car form--}}
<div class="container" id="car-form">
    <form method="POST" action="{{url('/student/createOrderCar')}}">
        @csrf
        <h2>Car</h2>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Pick Up Location</label>
            <input type="text" class="form-control" id="pickUpLocationC" name="pickUpLocation" required>
            <input type="hidden" class="form-control" id="latitudePickupC" name="latitudePickup" required>
            <input type="hidden" class="form-control" id="longitudePickupC" name="longitudePickup" required>
            <div class="form-text">Location you would like runner to pick up the parcel</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Drop Off Location</label>
            <input type="text" class="form-control" id="dropOffLocationC" name="dropOffLocation" required>
            <input type="hidden" class="form-control" id="latitudeDropOffC" name="latitudeDropOff" required>
            <input type="hidden" class="form-control" id="longitudeDropOffC" name="longitudeDropOff" required>
            <div class="form-text">Location you would like runner to submit the parcel</div>
        </div>
        <hr style="background-color:blue;height:3px;">
        <h5>Additional Services</h5>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="doorToDoor" name="DoorToDoor">
            <label class="form-check-label" for="exampleCheck1">Door-to-Door</label>
            <i class="fas fa-door-open"></i>
            <b class="float-end">(+RM 4)</b>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="ReturnTripCar" name="ReturnTrip">
            <label class="form-check-label" for="exampleCheck1">Return Trip</label>
            <i class="fas fa-exchange-alt"></i>
            <b class="float-end">(+RM 4)</b>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="BuyForYouCar" name="BuyForYou">
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
            <i class="fa fa-location-arrow" aria-hidden="true"></i> (RM1 for each 1KM)
            <b class="float-end"><b id="finalDistanceC"></b></b>
        </div>
        <h2>Order Price: RM <b id="orderFinalPriceCar"></b></h2>
        <input type="hidden" class="form-control" id="orderFinalPrice2Car" name="orderFinalPrice2" required>
        <input type="hidden" class="form-control" id="finalDistanceValC" name="finalDistanceValC" required>
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
    const d2d = document.getElementById('doorToDoor');
    const rtc = document.getElementById('ReturnTripCar');
    const b4uc = document.getElementById('BuyForYouCar');

    var ofpc = document.getElementById('orderFinalPriceCar');
    var ofp2c = document.getElementById('orderFinalPrice2Car');

    var disc = document.getElementById('finalDistanceC');
    var disc2 = document.getElementById('finalDistanceValC');

    disc2.value = 0;
    disc.innerHTML = '0 KM';
    ofpc.innerHTML = '4';
    ofp2c.value = '4';

    var latitudePickup = document.getElementById('latitudePickupC').value;
    var longitudePickup = document.getElementById('longitudePickupC').value;
    var latitudeDropOff = document.getElementById('latitudeDropOffC').value;
    var longitudeDropOff = document.getElementById('longitudeDropOffC').value;

    google.maps.event.addDomListener(window, 'load', initialize3);

    function initialize3() {

        var options = {
            componentRestrictions: {country: "MY"}
        };
        var pickUpLocation = document.getElementById('pickUpLocationC');
        var dropOffLocation = document.getElementById('dropOffLocationC');

        var autocomplete = new google.maps.places.Autocomplete(pickUpLocation, options);
        var autocomplete2 = new google.maps.places.Autocomplete(dropOffLocation, options);

        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            // console.log(place)
            $('#latitudePickupC').val(place.geometry['location'].lng());
            $('#longitudePickupC').val(place.geometry['location'].lat());

            latitudePickup = $('#latitudePickupC').val();
            longitudePickup = $('#longitudePickupC').val();
        });

        autocomplete2.addListener('place_changed', function() {
            var place = autocomplete2.getPlace();
            // console.log(place)
            $('#latitudeDropOffC').val(place.geometry['location'].lng());
            $('#longitudeDropOffC').val(place.geometry['location'].lat());

            latitudeDropOff = $('#latitudeDropOffC').val();
            longitudeDropOff = $('#longitudeDropOffC').val();

            getDistance();
        });
    }

    d2d.addEventListener('change', (event) => {
        //console.log(xbm.checked);
        if(d2d.checked) {
            // console.log('nilai sebelum ditambah ' + ofp2c.value);
            ofp2c.value = (parseFloat(ofp2c.value) + 4).toFixed(2);
            // console.log('nilai selepas ditambah ' + ofp2c.value);
            ofpc.innerHTML = ofp2c.value;
        }
        if(!d2d.checked) {
            // console.log('nilai sebelum ditolak ' + ofp2c.value);
            ofp2c.value = (parseFloat(ofp2c.value) - 4).toFixed(2);
            // console.log('nilai selepas ditolak ' + ofp2c.value);
            ofpc.innerHTML = ofp2c.value;
        }
        // console.log(ofp2m.value);
    });
    rtc.addEventListener('change', (event) => {
        // console.log(rtm.checked);
        if(rtc.checked) {
            // console.log('nilai sebelum ditambah ' + ofp2c.value);
            ofp2c.value = (parseFloat(ofp2c.value) + 4).toFixed(2);
            // console.log('nilai selepas ditambah ' + ofp2c.value);
            ofpc.innerHTML = ofp2c.value;
        }
        if(!rtc.checked) {
            // console.log('nilai sebelum ditolak ' + ofp2c.value);
            ofp2c.value = (parseFloat(ofp2c.value) - 4).toFixed(2);
            // console.log('nilai selepas ditolak ' + ofp2c.value);
            ofpc.innerHTML = ofp2c.value;
        }
        // console.log(ofp2m.value);
    });
    b4uc.addEventListener('change', (event) => {
        // console.log(b4um.checked);
        if(b4uc.checked) {
            // console.log('nilai sebelum ditambah ' + ofp2c.value);
            ofp2c.value = (parseFloat(ofp2c.value) + 4).toFixed(2);
            // console.log('nilai selepas ditambah ' + ofp2c.value);
            ofpc.innerHTML = ofp2c.value;
        }
        if(!b4uc.checked) {
            // console.log('nilai sebelum ditolak ' + ofp2c.value);
            ofp2c.value = (parseFloat(ofp2c.value) - 4).toFixed(2);
            // console.log('nilai selepas ditolak ' + ofp2c.value);
            ofpc.innerHTML = ofp2c.value;
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
            travelMode: google.maps.TravelMode.DRIVING,
            unitSystem: google.maps.UnitSystem.METRIC,
            avoidHighways: false,
            avoidTolls: false,
        };
        // get distance matrix response
        service.getDistanceMatrix(request).then((response) => {
            disc.innerHTML = response.rows[0].elements[0].distance.text.toUpperCase();
            var ret = response.rows[0].elements[0].distance.text.replace(' km','');
            disc2.value = parseFloat(ret);

            var a = parseFloat(ofp2c.value) + (parseFloat(disc2.value));
            var b = parseFloat(disc2.value);
            ofp2c.value = a.toFixed(2);
            ofpc.innerHTML = a.toFixed(2);
            disc.innerHTML += ' (+RM ' + b.toFixed(2) + ')';
            disc2.value = b.toFixed(2);
        });

        //Pangsapuri Bukit Beruang Utama, Taman Bukit Beruang Utama, ملقا،, Malacca, Malaysia
    }
</script>
{{--car form--}}

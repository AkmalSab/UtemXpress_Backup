{{--motorcycle form--}}
<div class="container" id="motorcycle-form">
    <form method="POST" action="{{url('/student/createOrderMotor')}}">
        @csrf
        <h2>Motorcycle</h2>
        <div class="mb-3">
            <label for="pickUpLocation" class="form-label">Pick Up Location</label>
            <input type="text" class="form-control" id="pickUpLocationM" name="pickUpLocation" required>
            <input type="hidden" class="form-control" id="latitudePickupM" name="latitudePickup" required>
            <input type="hidden" class="form-control" id="longitudePickupM" name="longitudePickup" required>
            <div class="form-text">Location you would like runner to pick up the parcel</div>
        </div>
        <div class="mb-3">
            <label for="dropOffLocation" class="form-label">Drop Off Location</label>
            <input type="text" class="form-control" id="dropOffLocationM" name="dropOffLocation" required>
            <input type="hidden" class="form-control" id="latitudeDropOffM" name="latitudeDropOff" required>
            <input type="hidden" class="form-control" id="longitudeDropOffM" name="longitudeDropOff" required>
            <div class="form-text">Location you would like runner to submit the parcel</div>
        </div>
        <hr style="background-color:blue;height:3px;">
        <h5>Additional Services</h5>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="XpressBagMotor" name="XpressBag">
            <label class="form-check-label" for="XpressBag">Xpress Bag</label>
            <i class="fa fa-briefcase" aria-hidden="true"></i>
            <b class="float-end">(+RM 0)</b>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="ReturnTripMotor" name="ReturnTrip">
            <label class="form-check-label" for="ReturnTrip">Return Trip</label>
            <i class="fas fa-exchange-alt"></i>
            <b class="float-end">(+RM 4)</b>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="BuyForYouMotor" name="BuyForYou">
            <label class="form-check-label" for="BuyForYou">Buy For You</label>
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
            <i class="fa fa-location-arrow" aria-hidden="true"></i> (RM0.80 for each 1KM)
            <b class="float-end"><b id="finalDistanceM"></b></b>
        </div>
        <h2>Order Price: RM <b id="orderFinalPriceMotor"></b></h2>
        <input type="hidden" class="form-control" id="orderFinalPrice2Motor" name="orderFinalPrice2" required>
        <input type="hidden" class="form-control" id="finalDistanceValM" name="finalDistanceValM" required>
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
    const xbm = document.getElementById('XpressBagMotor');
    const b4um = document.getElementById('BuyForYouMotor');
    const rtm = document.getElementById('ReturnTripMotor');

    var ofpm = document.getElementById('orderFinalPriceMotor');
    var ofp2m = document.getElementById('orderFinalPrice2Motor');
    var dism = document.getElementById('finalDistanceM');
    var dism2 = document.getElementById('finalDistanceValM');

    dism2.value = 0;
    dism.innerHTML = '0 KM';
    ofpm.innerHTML = '4';
    ofp2m.value = '4';

    var latitudePickup = document.getElementById('latitudePickupM').value;
    var longitudePickup = document.getElementById('longitudePickupM').value;
    var latitudeDropOff = document.getElementById('latitudeDropOffM').value;
    var longitudeDropOff = document.getElementById('longitudeDropOffM').value;

    google.maps.event.addDomListener(window, 'load', initialize2);

    function initialize2() {

        var options = {
            componentRestrictions: {country: "MY"}
        };

        var pickUpLocation = document.getElementById('pickUpLocationM');
        var dropOffLocation = document.getElementById('dropOffLocationM');

        var autocomplete = new google.maps.places.Autocomplete(pickUpLocation, options);
        var autocomplete2 = new google.maps.places.Autocomplete(dropOffLocation,options);

        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            // console.log(place)

            $('#latitudePickupM').val(place.geometry['location'].lng());
            $('#longitudePickupM').val(place.geometry['location'].lat());

            latitudePickup = $('#latitudePickupM').val();
            longitudePickup = $('#longitudePickupM').val();
        });

        autocomplete2.addListener('place_changed', function() {
            var place = autocomplete2.getPlace();
            // console.log(place)
            $('#latitudeDropOffM').val(place.geometry['location'].lng());
            $('#longitudeDropOffM').val(place.geometry['location'].lat());

            latitudeDropOff = $('#latitudeDropOffM').val();
            longitudeDropOff = $('#longitudeDropOffM').val();

            getDistance2();
        });
    }

    rtm.addEventListener('change', (event) => {
        // console.log(rtm.checked);
        if(rtm.checked) {
            // console.log('nilai sebelum ditambah ' + ofp2m.value);
            ofp2m.value = (parseFloat(ofp2m.value) + 4).toFixed(2);
            // console.log('nilai selepas ditambah ' + ofp2m.value);
            ofpm.innerHTML = ofp2m.value;
        }
        if(!rtm.checked) {
            // console.log('nilai sebelum ditolak ' + ofp2m.value);
            ofp2m.value = (parseFloat(ofp2m.value) - 4).toFixed(2);
            // console.log('nilai selepas ditolak ' + ofp2m.value);
            ofpm.innerHTML = ofp2m.value;
        }
        // console.log(ofp2m.value);
    });
    b4um.addEventListener('change', (event) => {
        // console.log(b4um.checked);
        if(b4um.checked) {
            // console.log('nilai sebelum ditambah ' + ofp2m.value);
            ofp2m.value = (parseFloat(ofp2m.value) + 4).toFixed(2);
            // console.log('nilai selepas ditambah ' + ofp2m.value);
            ofpm.innerHTML = ofp2m.value;
        }
        if(!b4um.checked) {
            // console.log('nilai sebelum ditolak ' + ofp2m.value);
            ofp2m.value = (parseFloat(ofp2m.value) - 4).toFixed(2);
            // console.log('nilai selepas ditolak ' + ofp2m.value);
            ofpm.innerHTML = ofp2m.value;
        }
        // console.log(ofp2m.value);
    });

    function getDistance2(){
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
            document.getElementById('finalDistanceM').innerHTML = response.rows[0].elements[0].distance.text.toUpperCase();
            var ret = response.rows[0].elements[0].distance.text.replace(' km','');
            dism2.value = parseFloat(ret);

            var a = parseFloat(ofp2m.value) + (parseFloat(dism2.value) * 0.8);
            var b = parseFloat(dism2.value) * 0.8;
            ofp2m.value = a.toFixed(2);
            ofpm.innerHTML = a.toFixed(2);
            dism.innerHTML += ' (+RM ' + b.toFixed(2) + ')';
            dism2.value = b.toFixed(2);
        });
    }
</script>
{{--motorcycle form--}}

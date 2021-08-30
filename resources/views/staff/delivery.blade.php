<!DOCTYPE html>
<html lang="en">
    <head>
        <x-head-component/>
    </head>
    <body>
    <x-header-component/>
        <div class="container mt-3" id="contactDetails">
            <form method="POST" action="{{url('/staff/submitOrder')}}">
                @csrf
                <h3>Delivery Date & Contact Information</h3>
                <div class="row mb-3">
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <input type="text" class="form-control col-12 mb-2" value="Today" disabled>
                        <input type="hidden" class="form-control col-12 mb-2" id="orderDate" name="orderDate">
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <input type="text" value="Now" class="form-control col-12" value="Now" disabled>
                        <input type="hidden" class="form-control col-12 mb-2" id="orderTime" name="orderTime">
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="UserPhone">Sender's Name:</label>
                    @foreach($users as $item)
                        <input type="text" class="form-control" id="senderName" name="senderName" value="{{$item->staff_name}}">
                    @endforeach
                </div>
                <div class="form-group mb-3">
                    <label for="UserPhone">Sender's Phone Number:</label>
                    <input type="tel" class="form-control" id="userPhone" name="userPhone" value="{{Auth::user()->user_phone}}" minlength="10" maxlength="12" onkeypress="return onlyNumberKey(event)">
                </div>
                <div class="form-group mb-3">
                    <label for="UserPhone">Receiver's Name:</label>
                    <input type="text" class="form-control" id="receiverName" name="receiverName" oninput="this.value = this.value.toUpperCase()">
                </div>
                <div class="form-group mb-3">
                    <label for="UserPhone">Receiver's Phone Number:</label>
                    <input type="tel" class="form-control" id="receiverPhone" name="receiverPhone" minlength="10" maxlength="12" onkeypress="return onlyNumberKey(event)">
                </div>
                <div class="form-group mb-3">
                    <label for="runnerNote">Note to your Runner:</label>
                    <textarea class="form-control" name="runnerNote" id="runnerNote" rows="3" placeholder="Please enter extra remarks for the runner"></textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="orderPrice"><h2>Order Price: <b>RM {{$orderPrice}}</b></h2></label>
                    <input type="hidden" class="form-control" name="pickUpLocation" id="pickUpLocation" value="{{$pickUpLocation}}">
                    <input type="hidden" class="form-control" name="latitudePickup" id="latitudePickup" value="{{$latitudePickup}}">
                    <input type="hidden" class="form-control" name="longitudePickup" id="longitudePickup" value="{{$longitudePickup}}">

                    <input type="hidden" class="form-control" name="dropOffLocation" id="dropOffLocation" value="{{$dropOffLocation}}">
                    <input type="hidden" class="form-control" name="latitudeDropOff" id="latitudeDropOff" value="{{$latitudeDropOff}}">
                    <input type="hidden" class="form-control" name="longitudeDropOff" id="longitudeDropOff" value="{{$longitudeDropOff}}">
                    <input type="hidden" class="form-control" name="XpressBag" id="XpressBag" value="{{$XpressBag}}">
                    <input type="hidden" class="form-control" name="BuyForYou" id="BuyForYou" value="{{$BuyForYou}}">
                    @isset($DoorToDoor)
                        <input type="hidden" class="form-control" name="DoorToDoor" id="DoorToDoor" value="{{$DoorToDoor}}">
                    @endisset
                    @isset($ReturnTrip)
                        <input type="hidden" class="form-control" name="ReturnTrip" id="ReturnTrip" value="{{$ReturnTrip}}">
                    @endisset
                    <input type="hidden" class="form-control" name="vehicle" id="vehicle" value="{{$vehicle}}">
                    <input type="hidden" class="form-control" name="orderPrice" id="orderPrice" value="{{$orderPrice}}">
                </div>
                <div class="form-group mb-3">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <input type="submit"  value="Confirm Order" class="btn btn-primary col-12 mb-3">
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <input type="reset"  value="Reset Order" class="btn btn-warning col-12">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </body>
    <script>
        function onlyNumberKey(evt) {
            // Only ASCII charactar in that range allowed
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode
            if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
                return false;
            return true;
        }

        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        today = yyyy + '/' + mm + '/' + dd;

        var d = new Date(),
            h = (d.getHours()<10?'0':'') + d.getHours(),
            m = (d.getMinutes()<10?'0':'') + d.getMinutes(),
            s = (d.getSeconds());

        var time = h + ':' + m + ':' + s;
        document.getElementById("orderDate").value = today;
        document.getElementById("orderTime").value = time;
    </script>
</html>

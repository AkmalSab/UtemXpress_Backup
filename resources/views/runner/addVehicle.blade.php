<!-- Add Vehicle Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Vehicle Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{url('/runner/insertRunnerVehicle')}}" enctype="multipart/form-data" class="needs-validation" id="vehicleForm">
                    @csrf
                    <div class="mb-3">
                        <label for="vehicleTypeInput" class="form-label">Vehicle Type:</label>
                        <select class="form-select" aria-label="Default select example" id="vehicleType" name="vehicleType" required onchange="test();">
                            <option selected>Type of vehicle</option>
                            <option value="Walk / Bicycle">Walk / Bicycle</option>
                            <option value="Motorcycle">Motorcycle</option>
                            <option value="Car">Car</option>
                        </select>
                    </div>
                </form>
                <div class="mb-3" id="vehicleDiv" style="visibility: hidden;">
                    <label for="vehiclePlateNumberInputLabel" class="form-label">Vehicle Plate Number:</label>
                    <input type="text" class="form-control" id="vehiclePlateNumberInput" name="vehiclePlateNumber" oninput="this.value = this.value.toUpperCase()" required>
                </div>
                <div class="mb-3" id="vehicleDiv2" style="visibility: hidden;">
                    <label for="vehicleImageInput" class="form-label">Vehicle Image:</label>
                    <div class="mb-3">
                        <input class="form-control" type="file" id="vehicleImage" name="vehicleImage" onchange="uploadVehicleInfo('vehicle')" required>
                        <div class="mt-3 alert alert-warning" id="vehicleImageError" role="alert">
                            <strong>Alert</strong> Files uploaded in non-picture format
                        </div>
                        <input class="form-control" type="hidden" id="vehicleImageUrl" name="vehicleImageUrl">
                    </div>
                </div>
                <div class="mb-3" id="vehicleDiv3" style="visibility: hidden;">
                    <label for="vehicleRoadtaxInput" class="form-label">Vehicle Roadtax Image:</label>
                    <div class="mb-3">
                        <input class="form-control" type="file" id="vehicleRoadtaxImage" name="vehicleRoadtaxImage" onchange="uploadVehicleInfo('roadtax')" required>
                        <div class="mt-3 alert alert-warning" id="vehicleRoadtaxImageError" role="alert">
                            <strong>Alert</strong> Files uploaded in non-picture format
                        </div>
                        <input class="form-control" type="hidden" id="vehicleRoadtaxImageUrl" name="vehicleRoadtaxImageUrl">
                    </div>
                </div>
                <div class="mb-3 text-center" id="loadingButton3">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Please wait
                </div>
                <button type="submit" class="btn btn-primary" id="submit" style="visibility: hidden;">Submit</button>
                <button type="reset" class="btn btn-warning" id="reset" style="visibility: hidden;">Reset</button>
                <script>

                    document.getElementById('submit').disabled = true;
                    document.getElementById('loadingButton3').style.display = 'none';
                    document.getElementById('vehicleImageError').style.display = 'none';
                    document.getElementById('vehicleRoadtaxImageError').style.display = 'none';

                    // Allowing file type
                    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.tiff|\.jfif)$/i;

                    function uploadVehicleInfo(param){

                        if(param === 'vehicle'){

                            var vehicleImageUrl = document.getElementById('vehicleImageUrl');
                            var vehicleImage = document.getElementById('vehicleImage');

                            var filePath = vehicleImage.value;
                            console.log('filePath = ' + filePath);

                            if (!allowedExtensions.exec(filePath)) {
                                vehicleImage.value = '';
                                vehicleImageUrl.value = '';
                                document.getElementById('vehicleImageError').style.display = 'block';
                                return false;
                            }
                            else{
                                document.getElementById('loadingButton3').style.display = 'block';
                                document.getElementById('vehicleImageError').style.display = 'none';

                                const ref = firebase.storage().ref();
                                const file = document.querySelector('#vehicleImage').files[0]
                                const name = file.name;
                                const metadata = {
                                    contentType: file.type
                                };
                                const task = ref.child(name).put(file, metadata);
                                task
                                    .then(snapshot => snapshot.ref.getDownloadURL())
                                    .then((url) => {
                                        console.log(url);
                                        document.getElementById('loadingButton3').style.display = 'none';
                                        document.getElementById('vehicleImageUrl').value = url;
                                    })
                                    .catch(console.error);
                            }
                        }
                        else if(param === 'roadtax'){

                            var vehicleRoadtaxImageUrl = document.getElementById('vehicleRoadtaxImageUrl');
                            var vehicleRoadtaxImage = document.getElementById('vehicleRoadtaxImage');

                            var filePath2 = vehicleRoadtaxImage.value;
                            console.log('filePath2 = ' + filePath2);

                            if (!allowedExtensions.exec(filePath2)) {
                                vehicleRoadtaxImage.value = '';
                                vehicleRoadtaxImageUrl.value = '';
                                document.getElementById('vehicleRoadtaxImageError').style.display = 'block';
                                return false;
                            }
                            else{
                                document.getElementById('vehicleRoadtaxImageError').style.display = 'none';
                                document.getElementById('loadingButton3').style.display = 'block';

                                const ref = firebase.storage().ref();
                                const file = document.querySelector('#vehicleRoadtaxImage').files[0]
                                const name = file.name;
                                const metadata = {
                                    contentType: file.type
                                };
                                const task = ref.child(name).put(file, metadata);
                                task
                                    .then(snapshot => snapshot.ref.getDownloadURL())
                                    .then((url) => {
                                        console.log(url);
                                        document.getElementById('loadingButton3').style.display = 'none';
                                        document.getElementById('vehicleRoadtaxImageUrl').value = url;
                                        document.getElementById('submit').disabled = false;
                                    })
                                    .catch(console.error);
                            }
                        }
                    }

                    function test(){
                        var vehicleType = document.getElementById('vehicleType').value;

                        var form = document.getElementById("vehicleForm");
                        var v1 = document.getElementById("vehicleDiv");
                        var v2 = document.getElementById("vehicleDiv2");
                        var v3 = document.getElementById("vehicleDiv3");
                        var submit = document.getElementById("submit");
                        var reset = document.getElementById("reset");
                        if(vehicleType === "Walk / Bicycle"){
                            document.getElementById('submit').disabled = false;
                            form.appendChild(submit);
                            form.appendChild(reset);
                            submit.style.visibility = 'visible';
                            reset.style.visibility = 'visible';
                            document.getElementById("vehicleDiv").style.visibility = "hidden";
                            document.getElementById("vehicleDiv2").style.visibility = 'hidden';
                            document.getElementById("vehicleDiv3").style.visibility = 'hidden';
                        }
                        else{
                            form.appendChild(v1);
                            form.appendChild(v2);
                            form.appendChild(v3);
                            form.appendChild(submit);
                            form.appendChild(reset);
                            submit.style.visibility = 'visible';
                            reset.style.visibility = 'visible';
                            document.getElementById("vehicleDiv").style.visibility = 'visible';
                            document.getElementById("vehicleDiv2").style.visibility = 'visible';
                            document.getElementById("vehicleDiv3").style.visibility = 'visible';
                        }
                    }
                </script>
            </div>
        </div>
    </div>
</div>
<!-- Add Vehicle Modal -->

<!-- Vehicle Image Modal -->
<div class="modal fade" id="VehiclestaticBackdrop" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Vehicle Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                @foreach($vehicledDetails as $items)
                    <img src="{{$items->vehicle_picture}}" class="img-fluid w-75 h-75" alt="vehicle_image">
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Vehicle Image Modal -->

<!-- Vehicle Roadtax Image Modal -->
<div class="modal fade" id="RoadtaxstaticBackdrop" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Roadtax Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                @foreach($vehicledDetails as $items)
                    <img src="{{$items->vehicle_roadtax_picture}}" class="img-fluid w-75 h-75" alt="vehicle_image">
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Vehicle Roadtax Image Modal -->

<!-- Update Vehicle Modal -->
<div class="modal fade" id="UpdateVehiclestaticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Vehicle Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{url('/runner/updateRunnerVehicle')}}" enctype="multipart/form-data" id="updateVehicleForm">
                    @csrf
                    @foreach($vehicledDetails as $items)
                        <div class="mb-3">
                            <label for="vehicleTypeInput" class="form-label">Vehicle Type:</label>
                                @if($items->vehicle_type == "Walk / Bicycle")
                                <select class="form-select" aria-label="Default select example" name="vehicleType" id="updateVehicleType" required onchange="updateVehicleForm()">
                                    <option>Type of vehicle</option>
                                    <option value="Walk / Bicycle" selected>Walk / Bicycle</option>
                                    <option value="Motorcycle">Motorcycle</option>
                                    <option value="Car">Car</option>
                                </select>
                                @elseif($items->vehicle_type == "Motorcycle")
                                <select class="form-select" aria-label="Default select example" name="vehicleType" id="updateVehicleType" required onchange="updateVehicleForm()">
                                    <option>Type of vehicle</option>
                                    <option value="Walk / Bicycle">Walk / Bicycle</option>
                                    <option value="Motorcycle" selected>Motorcycle</option>
                                    <option value="Car">Car</option>
                                </select>
                                @elseif($items->vehicle_type == "Car")
                                <select class="form-select" aria-label="Default select example" name="vehicleType" id="updateVehicleType" required onchange="updateVehicleForm()">
                                    <option>Type of vehicle</option>
                                    <option value="Walk / Bicycle">Walk / Bicycle</option>
                                    <option value="Motorcycle">Motorcycle</option>
                                    <option value="Car" selected>Car</option>
                                </select>
                                @else
                                <select class="form-select" aria-label="Default select example" name="vehicleType" id="updateVehicleType" required onchange="updateVehicleForm()">
                                    <option selected>Type of vehicle</option>
                                    <option value="Walk / Bicycle">Walk / Bicycle</option>
                                    <option value="Motorcycle">Motorcycle</option>
                                    <option value="Car">Car</option>
                                </select>
                                @endif
                        </div>
                    @endforeach
                </form>
                <div class="mb-3" id="updatePlateNumberDiv" style="visibility:hidden;">
                    <label for="vehiclePlateNumberInputUpdateLabel" class="form-label">Vehicle Plate Number:</label>
                    <input type="text" class="form-control" id="vehiclePlateNumberUpdate" name="vehiclePlateNumberUpdate" oninput="this.value = this.value.toUpperCase()" required>
                </div>
                <div class="mb-3" id="updateVehicleImageDiv" style="visibility:hidden;">
                    <label for="vehicleImageInputUpdateLabel" class="form-label">Vehicle Image:</label>
                    <div class="mb-3">
                        <input class="form-control" type="file" id="vehicleImageUpdate" name="vehicleImageUpdate" onchange="updateVehicleInfo('vehicleImageUpdate')" required>
                        <input class="form-control" type="hidden" id="vehicleImageUpdateUrl" name="vehicleImageUpdateUrl">
                        <div class="mt-3 alert alert-warning" id="vehicleImageUpdateError" role="alert">
                            <strong>Alert</strong> Files uploaded in non-picture format
                        </div>
                    </div>
                </div>
                <div class="mb-3" id="updateRoadtaxImageDiv" style="visibility:hidden;">
                    <label for="vehicleRoadtaxInputUpdateLabel" class="form-label">Vehicle Roadtax Image:</label>
                    <div class="mb-3">
                        <input class="form-control" type="file" id="vehicleRoadtaxImageUpdate" name="vehicleRoadtaxImageUpdate" onchange="updateVehicleInfo('vehicleRoadtaxImageUpdate')" required>
                        <input class="form-control" type="hidden" id="vehicleRoadtaxImageUpdateUrl" name="vehicleRoadtaxImageUpdateUrl">
                        <div class="mt-3 alert alert-warning" id="vehicleRoadtaxImageUpdateError" role="alert">
                            <strong>Alert</strong> Files uploaded in non-picture format
                        </div>
                    </div>
                </div>
                <div class="mb-3 text-center" id="loadingButton4">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Please wait
                </div>
                <button type="submit" class="me-1 btn btn-primary" style="visibility:hidden;" id="submitUpdate">Submit</button>
                <button type="reset" class="btn btn-warning" style="visibility:hidden;" id="submitReset">Reset</button>
            </div>
        </div>
    </div>
</div>
<!-- Update Vehicle Modal -->

<script>

    document.getElementById('submitUpdate').disabled = true;
    document.getElementById('loadingButton4').style.display = 'none';

    // Error div
    document.getElementById('vehicleImageUpdateError').style.display = 'none';
    document.getElementById('vehicleRoadtaxImageUpdateError').style.display = 'none';

    function updateVehicleInfo(param){

        if(param === 'vehicleImageUpdate'){
            var vehicleImageUpdate = document.getElementById('vehicleImageUpdate');
            var vehicleImageUpdateUrl = document.getElementById('vehicleImageUpdateUrl');

            var filePath3 = vehicleImageUpdate.value;

            if (!allowedExtensions.exec(filePath3)) {
                vehicleImageUpdate.value = '';
                vehicleImageUpdateUrl.value = '';
                document.getElementById('vehicleImageUpdateError').style.display = 'block';
                return false;
            }
            else{
                document.getElementById('loadingButton4').style.display = 'block';
                document.getElementById('vehicleImageUpdateError').style.display = 'none';
                const ref = firebase.storage().ref();
                const file = document.querySelector('#vehicleImageUpdate').files[0]
                const name = file.name;
                const metadata = {
                    contentType: file.type
                };
                const task = ref.child(name).put(file, metadata);
                task
                    .then(snapshot => snapshot.ref.getDownloadURL())
                    .then((url) => {
                        document.getElementById('loadingButton4').style.display = 'none';
                        document.getElementById('vehicleImageUpdateUrl').value = url;
                    })
                    .catch(console.error);
            }


        }
        else if(param === 'vehicleRoadtaxImageUpdate'){

            var vehicleRoadtaxImageUpdate = document.getElementById('vehicleRoadtaxImageUpdate');
            var vehicleRoadtaxImageUpdateUrl = document.getElementById('vehicleRoadtaxImageUpdateUrl');

            var filePath4 = vehicleRoadtaxImageUpdate.value;

            if (!allowedExtensions.exec(filePath4)) {
                vehicleRoadtaxImageUpdate.value = '';
                vehicleRoadtaxImageUpdateUrl.value = '';
                document.getElementById('vehicleRoadtaxImageUpdateError').style.display = 'block';
                return false;
            }
            else{
                document.getElementById('loadingButton4').style.display = 'block';
                document.getElementById('vehicleRoadtaxImageUpdateError').style.display = 'none';

                const ref = firebase.storage().ref();
                const file = document.querySelector('#vehicleRoadtaxImageUpdate').files[0]
                const name = file.name;
                const metadata = {
                    contentType: file.type
                };
                const task = ref.child(name).put(file, metadata);
                task
                    .then(snapshot => snapshot.ref.getDownloadURL())
                    .then((url) => {
                        document.getElementById('loadingButton4').style.display = 'none';
                        document.getElementById('vehicleRoadtaxImageUpdateUrl').value = url;
                        document.getElementById('submitUpdate').disabled = false;
                    })
                    .catch(console.error);
            }
        }
    }

    function updateVehicleForm(){
        var updateVehicleType = document.getElementById('updateVehicleType').value;
        var updateVehicleForm = document.getElementById("updateVehicleForm");
        var v1 = document.getElementById("updatePlateNumberDiv");
        var v2 = document.getElementById("updateVehicleImageDiv");
        var v3 = document.getElementById("updateRoadtaxImageDiv");
        var submit = document.getElementById("submitUpdate");
        var reset = document.getElementById("submitReset");

        if(updateVehicleType === "Walk / Bicycle"){
            updateVehicleForm.removeChild(v1);
            updateVehicleForm.removeChild(v2);
            updateVehicleForm.removeChild(v3);
            document.getElementById('submitUpdate').disabled = false;
            updateVehicleForm.appendChild(submit);
            updateVehicleForm.appendChild(reset);
            submit.style.visibility = 'visible';
            reset.style.visibility = 'visible';
            // v1.style.visibility = 'hidden';
            // v2.style.visibility = 'hidden';
            // v3.style.visibility = 'hidden';
        }
        else
        {
            updateVehicleForm.appendChild(v1);
            updateVehicleForm.appendChild(v2);
            updateVehicleForm.appendChild(v3);
            updateVehicleForm.appendChild(submit);
            updateVehicleForm.appendChild(reset);
            submit.style.visibility = 'visible';
            reset.style.visibility = 'visible';
            v1.style.visibility = 'visible';
            v2.style.visibility = 'visible';
            v3.style.visibility = 'visible';
        }
    }
</script>

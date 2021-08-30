<!-- Add image Modal -->
<div class="modal fade" id="addImage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Personal Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="modal-error"></div>
                <form method="POST" action="{{url('/runner/insertRunnerImage')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="LicenseFrontImage" class="form-label">Image:</label>
                        <div class="mb-3">
                            <input class="form-control" type="file" id="personalImage" name="personalImage" onchange="upload('image')" required>
                            <input class="form-control" type="hidden" id="personalImageUrl" name="personalImageUrl">
                            <div class="mt-3 alert alert-warning" id="personalImageError" role="alert">
                                <strong>Alert</strong> Files uploaded in non-picture format
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 text-center" id="loadingButton">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Please wait
                    </div>
                    <button type="submit" id="uploadImg" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add image Modal -->

<!-- Add License Modal -->
<div class="modal fade" id="addLicensestaticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add License Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="modal-error2"></div>
                <form method="POST" action="{{url('/runner/insertRunnerLicense')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="LicenseFrontImageLabel" class="form-label">License Front Image:</label>
                        <div class="mb-3">
                            <input class="form-control" type="file" id="LicenseFrontImage" name="LicenseFrontImage" onchange="upload('LicenseFrontImage')" required>
                            <input class="form-control" type="hidden" id="LicenseFrontImageUrl" name="LicenseFrontImageUrl">
                            <div class="mt-3 alert alert-warning" id="LicenseFrontImageError" role="alert">
                                <strong>Alert</strong> Files uploaded in non-picture format
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="LicenseBackImageLabel" class="form-label">License Back Image:</label>
                        <div class="mb-3">
                            <input class="form-control" type="file" id="LicenseBackImage" name="LicenseBackImage" onchange="upload('LicenseBackImage')" required>
                            <input class="form-control" type="hidden" id="LicenseBackImageUrl" name="LicenseBackImageUrl">
                            <div class="mt-3 alert alert-warning" id="LicenseBackImageError" role="alert">
                                <strong>Alert</strong> Files uploaded in non-picture format
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 text-center" id="loadingButton2">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Please wait
                    </div>
                    <button type="submit" id="uploadImg2" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add License Modal -->

<!-- Personal Image Modal -->
<div class="modal fade" id="showImage" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Personal Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="{{Auth::user()->user_picture}}" class="img-fluid" alt="personal_image">
            </div>
        </div>
    </div>
</div>
<!-- Personal Image Modal -->

<!-- License front Image Modal -->
<div class="modal fade" id="LicenseFrontstaticBackdrop" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">License Front</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @foreach($license as $items)
                    <img src="{{$items->runner_license_picture_front}}" class="img-fluid" alt="vehicle_image">
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- License front Image Modal -->

<!-- License back Image Modal -->
<div class="modal fade" id="LicenseBackstaticBackdrop" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">License Back</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @foreach($license as $items)
                    <img src="{{$items->runner_license_picture_back}}" class="img-fluid" alt="vehicle_image">
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- License back Image Modal -->

<!-- Update License Modal -->
<div class="modal fade" id="LicenseUpdatestaticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update License Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{url('/runner/updateRunnerLicense')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="LicenseFrontImageUpdateLabel" class="form-label">License Front Image:</label>
                        <div class="mb-3">
                            <input class="form-control" type="file" id="LicenseFrontImageUpdate" name="LicenseFrontImageUpdate" onchange="upload('LicenseFrontImageUpdate')" required>
                            <input class="form-control" type="hidden" id="LicenseFrontImageUpdateUrl" name="LicenseFrontImageUpdateUrl">
                            <div class="mt-3 alert alert-warning" id="LicenseFrontImageUpdateError" role="alert">
                                <strong>Alert</strong> Files uploaded in non-picture format
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="LicenseBackImageUpdateLabel" class="form-label">License Back Image:</label>
                        <div class="mb-3">
                            <input class="form-control" type="file" id="LicenseBackImageUpdate" name="LicenseBackImageUpdate" onchange="upload('LicenseBackImageUpdate')" required>
                            <input class="form-control" type="hidden" id="LicenseBackImageUpdateUrl" name="LicenseBackImageUpdateUrl">
                            <div class="mt-3 alert alert-warning" id="LicenseBackImageUpdateError" role="alert">
                                <strong>Alert</strong> Files uploaded in non-picture format
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 text-center" id="loadingButton5">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Please wait
                    </div>
                    <button type="submit" id="submitUpdateLicense" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Update License Modal -->

<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.7.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.7.1/firebase-storage.js"></script>
<!-- script to upload image to firebase -->
<script>

    document.getElementById('uploadImg').disabled = true;
    document.getElementById('uploadImg2').disabled = true;
    document.getElementById('submitUpdateLicense').disabled = true;
    document.getElementById('loadingButton').style.display = 'none';
    document.getElementById('loadingButton2').style.display = 'none';
    document.getElementById('loadingButton5').style.display = 'none';

    document.getElementById('LicenseFrontImageError').style.display = 'none';
    document.getElementById('LicenseBackImageError').style.display = 'none';
    document.getElementById('personalImageError').style.display = 'none';
    document.getElementById('LicenseFrontImageUpdateError').style.display = 'none';
    document.getElementById('LicenseBackImageUpdateError').style.display = 'none';


    // Your web app's Firebase configuration
    var firebaseConfig = {
        apiKey: "AIzaSyC0Bp0Yqp0z1uuBamQuEpg9GBeZyhTJ24w",
        authDomain: "utemxpress.firebaseapp.com",
        projectId: "utemxpress",
        storageBucket: "utemxpress.appspot.com",
        messagingSenderId: "851675193601",
        appId: "1:851675193601:web:b3044ba859bde8ca8e7b00"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);

    // Allowing file type
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.tiff|\.jfif)$/i;

    function upload(param){
        if(param === 'image'){

            var personalImage = document.getElementById('personalImage');
            var personalImageUrl = document.getElementById('personalImageUrl');

            var filePath = personalImage.value;

            if (!allowedExtensions.exec(filePath)) {
                personalImage.value = '';
                personalImageUrl.value = '';
                document.getElementById('personalImageError').style.display = 'block';
                return false;
            }
            else{
                document.getElementById('personalImageError').style.display = 'none';
                document.getElementById('loadingButton').style.display = 'block';
                const ref = firebase.storage().ref();
                const file = document.querySelector('#personalImage').files[0]
                const name = file.name;
                const metadata = {
                    contentType: file.type
                };
                const task = ref.child(name).put(file, metadata);
                task
                    .then(snapshot => snapshot.ref.getDownloadURL())
                    .then((url) => {
                        document.getElementById('loadingButton').style.display = 'none';
                        document.getElementById('uploadImg').disabled = false;
                        document.getElementById('personalImageUrl').value = url;
                    })
                    .catch(console.error);
            }
        }
        else if(param === 'LicenseFrontImage'){

            var LicenseFrontImageUrl = document.getElementById('LicenseFrontImageUrl');
            var LicenseFrontImage = document.getElementById('LicenseFrontImage');

            var filePath2 = LicenseFrontImage.value;

            if (!allowedExtensions.exec(filePath2)) {
                LicenseFrontImage.value = '';
                LicenseFrontImageUrl.value = '';
                document.getElementById('LicenseFrontImageError').style.display = 'block';
                return false;
            }
            else{
                document.getElementById('uploadImg2').disabled = true;
                document.getElementById('LicenseFrontImageError').style.display = 'none';
                document.getElementById('loadingButton2').style.display = 'block';
                const ref = firebase.storage().ref();
                const file = document.querySelector('#LicenseFrontImage').files[0]
                const name = file.name;
                const metadata = {
                    contentType: file.type
                };
                const task = ref.child(name).put(file, metadata);
                task
                    .then(snapshot => snapshot.ref.getDownloadURL())
                    .then((url) => {
                        document.getElementById('loadingButton2').style.display = 'none';
                        document.getElementById('LicenseFrontImageUrl').value = url;
                    })
                    .catch(console.error);
            }
        }
        else if(param === 'LicenseBackImage'){
            var LicenseBackImageUrl = document.getElementById('LicenseBackImageUrl');
            var LicenseBackImage = document.getElementById('LicenseBackImage');

            var filePath3 = LicenseBackImage.value;

            if (!allowedExtensions.exec(filePath3)) {
                LicenseBackImage.value = '';
                LicenseBackImageUrl.value = '';
                document.getElementById('LicenseBackImageError').style.display = 'block';
                return false;
            }
            else{
                document.getElementById('uploadImg2').disabled = true;
                document.getElementById('LicenseBackImageError').style.display = 'none';
                document.getElementById('loadingButton2').style.display = 'block';
                const ref = firebase.storage().ref();
                const file = document.querySelector('#LicenseBackImage').files[0]
                const name = file.name;
                const metadata = {
                    contentType: file.type
                };
                const task = ref.child(name).put(file, metadata);
                task
                    .then(snapshot => snapshot.ref.getDownloadURL())
                    .then((url) => {
                        document.getElementById('loadingButton2').style.display = 'none';
                        document.getElementById('LicenseBackImageUrl').value = url;
                        document.getElementById('uploadImg2').disabled = false;
                    })
                    .catch(console.error);
            }
        }
        else if(param === 'LicenseFrontImageUpdate'){

            var LicenseFrontImageUpdate = document.getElementById('LicenseFrontImageUpdate');
            var LicenseFrontImageUpdateUrl = document.getElementById('LicenseFrontImageUpdateUrl');

            var filePath4 = LicenseFrontImageUpdate.value;

            if (!allowedExtensions.exec(filePath4)) {
                LicenseFrontImageUpdate.value = '';
                LicenseFrontImageUpdateUrl.value = '';
                document.getElementById('LicenseFrontImageUpdateError').style.display = 'block';
                return false;
            }
            else{
                document.getElementById('LicenseFrontImageUpdateError').style.display = 'none';
                document.getElementById('loadingButton5').style.display = 'block';
                const ref = firebase.storage().ref();
                const file = document.querySelector('#LicenseFrontImageUpdate').files[0]
                const name = file.name;
                const metadata = {
                    contentType: file.type
                };
                const task = ref.child(name).put(file, metadata);
                task
                    .then(snapshot => snapshot.ref.getDownloadURL())
                    .then((url) => {
                        document.getElementById('loadingButton5').style.display = 'none';
                        document.getElementById('LicenseFrontImageUpdateUrl').value = url;
                    })
                    .catch(console.error);
            }
        }
        else if(param === 'LicenseBackImageUpdate'){

            var LicenseBackImageUpdate = document.getElementById('LicenseBackImageUpdate');
            var LicenseBackImageUpdateUrl = document.getElementById('LicenseBackImageUpdateUrl');

            var filePath5 = LicenseBackImageUpdate.value;

            if (!allowedExtensions.exec(filePath5)) {
                LicenseBackImageUpdate.value = '';
                LicenseBackImageUpdateUrl.value = '';
                document.getElementById('LicenseBackImageUpdateError').style.display = 'block';
                return false;
            }
            else {
                document.getElementById('LicenseBackImageUpdateError').style.display = 'none';
                document.getElementById('loadingButton5').style.display = 'block';
                const ref = firebase.storage().ref();
                const file = document.querySelector('#LicenseBackImageUpdate').files[0]
                const name = file.name;
                const metadata = {
                    contentType: file.type
                };
                const task = ref.child(name).put(file, metadata);
                task
                    .then(snapshot => snapshot.ref.getDownloadURL())
                    .then((url) => {
                        document.getElementById('loadingButton5').style.display = 'none';
                        document.getElementById('LicenseBackImageUpdateUrl').value = url;
                        document.getElementById('submitUpdateLicense').disabled = false;
                    })
                    .catch(console.error);
            }
        }
    }
</script>

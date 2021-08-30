<!-- Add IC Front Image Modal -->
<div class="modal fade" id="addIcImage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Admin IC Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{url('/admin/insertIcImage')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="IcFrontImage" class="form-label">IC Front Image:</label>
                        <div class="mb-3">
                            <input class="form-control" type="file" id="IcFrontImage" name="IcFrontImage" onchange="uploadImage(1)" required>
                            <input class="form-control" type="hidden" id="IcFrontImageUrl" name="IcFrontImageUrl">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="IcBackImage" class="form-label">IC Back Image:</label>
                        <div class="mb-3">
                            <input class="form-control" type="file" id="IcBackImage" name="IcBackImage" onchange="uploadImage(2)" required>
                            <input class="form-control" type="hidden" id="IcBackImageUrl" name="IcBackImageUrl">
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
<!-- Add IC Front Image Modal -->

<!-- Add Image Modal -->
<div class="modal fade" id="addImage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Admin Personal Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{url('/admin/insertImage')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="UserImage" class="form-label">Personal Image:</label>
                        <div class="mb-3">
                            <input class="form-control" type="file" id="UserImage" name="UserImage" onchange="uploadImage(3)" required>
                            <input class="form-control" type="hidden" id="UserImageUrl" name="UserImageUrl">
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
<!-- Add Image Modal -->

<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.7.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.7.1/firebase-storage.js"></script>
<!-- script to upload image to firebase -->
<script>

    document.getElementById('uploadImg').disabled = true;
    document.getElementById('uploadImg2').disabled = true;
    document.getElementById('loadingButton').style.display = 'none';
    document.getElementById('loadingButton2').style.display = 'none';

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

    function uploadImage(a){

        if(a === 1){
            document.getElementById('loadingButton').style.display = 'block';
            const ref = firebase.storage().ref();
            const file = document.querySelector('#IcFrontImage').files[0]
            const name = file.name;
            const metadata = {
                contentType: file.type
            };
            const task = ref.child(name).put(file, metadata);
            task
                .then(snapshot => snapshot.ref.getDownloadURL())
                .then((url) => {
                    document.getElementById('loadingButton').style.display = 'none';
                    document.getElementById('IcFrontImageUrl').value = url;
                })
                .catch(console.error);
        }else if(a === 2){
            document.getElementById('loadingButton').style.display = 'block';
            const ref = firebase.storage().ref();
            const file = document.querySelector('#IcBackImage').files[0]
            const name = file.name;
            const metadata = {
                contentType: file.type
            };
            const task = ref.child(name).put(file, metadata);
            task
                .then(snapshot => snapshot.ref.getDownloadURL())
                .then((url) => {
                    document.getElementById('loadingButton').style.display = 'none';
                    document.getElementById('IcBackImageUrl').value = url;
                    document.getElementById('uploadImg').disabled = false;
                })
                .catch(console.error);
        }else if(a === 3){
            document.getElementById('loadingButton2').style.display = 'block';
            const ref = firebase.storage().ref();
            const file = document.querySelector('#UserImage').files[0]
            const name = file.name;
            const metadata = {
                contentType: file.type
            };
            const task = ref.child(name).put(file, metadata);
            task
                .then(snapshot => snapshot.ref.getDownloadURL())
                .then((url) => {
                    document.getElementById('loadingButton2').style.display = 'none';
                    document.getElementById('UserImageUrl').value = url;
                    document.getElementById('uploadImg2').disabled = false;
                })
                .catch(console.error);
        }
    }
</script>


<!-- Show Image Modal -->
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
<!-- Show Image Modal -->

<!-- Show IC Front Image Modal -->
<div class="modal fade" id="showIcFront" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">IC Front Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="{{Auth::user()->user_nric_picture_front}}" class="img-fluid" alt="showIcFront">
            </div>
        </div>
    </div>
</div>
<!-- Show IC Front Image Modal -->

<!-- Show IC Back Image Modal -->
<div class="modal fade" id="showIcBack" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">IC Back Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="{{Auth::user()->user_nric_picture_back}}" class="img-fluid" alt="showIcBack">
            </div>
        </div>
    </div>
</div>
<!-- Show IC Back Image Modal -->

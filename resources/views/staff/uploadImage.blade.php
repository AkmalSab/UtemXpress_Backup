<html>
<head>
    <title>upload image to firebase</title>
    <style>
        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite; /* Safari */
            animation: spin 2s linear infinite;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
<center>
    <form method="POST" ACTION="{{url('/staff/getImg')}}" enctype="multipart/form-data">
        @csrf
        <label>select image : </label>
        <input type="file" id="image" accept="image/*" onchange="upload()"><br><br>
        <input type="text" id="imageUrl" name="imageUrl"><br><br>
        <div class="loader" id="loader"></div>
        <button type="submit" id="uploadImg">Upload</button>
    </form>
</center>
<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.7.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.7.1/firebase-storage.js"></script>

<script>

    document.getElementById('uploadImg').disabled = true;
    document.getElementById('loader').style.display = 'none';

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

    function upload(){
        document.getElementById('uploadImg').disabled = true;
        document.getElementById('loader').style.display = 'block';
        const ref = firebase.storage().ref();
        const file = document.querySelector('#image').files[0]
        const name = file.name;
        const metadata = {
            contentType: file.type
        };
        const task = ref.child(name).put(file, metadata);
        task
            .then(snapshot => snapshot.ref.getDownloadURL())
            .then((url) => {
                document.getElementById('loader').style.display = 'none';
                console.log(url);
                document.getElementById('uploadImg').disabled = false;
                document.querySelector('#image').src = url;
                document.getElementById('imageUrl').value = url;
            })
            .catch(console.error);
    }
</script>
</body>
</html>

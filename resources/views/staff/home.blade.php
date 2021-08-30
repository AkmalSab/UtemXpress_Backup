<!DOCTYPE html>
<html lang="en">
<head>
    <x-head-component/>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCD_MzxRlzk37ggGXXy2zOV8noROMoqDjI&libraries=places"></script>
</head>
<body onload="hideSomeForm()">
<x-header-component/>
<div class="row mt-1">
    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
        <div class="container">
            <div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false" data-bs-interval="false">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="/img/walk-slide.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="/img/motor-slide.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="/img/car-slide.png" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
        @include('staff.walk')
        @include('staff.motorcycle')
        @include('staff.car')
    </div>
</div>
</body>

<script type="text/javascript">

    var element = document.getElementsByClassName("nav-link placeorder");
    element[0].classList.add("active");

    function hideSomeForm(){
        document.getElementById('motorcycle-form').style.display = "none";
        document.getElementById('car-form').style.display = "none";
        document.getElementById('walk-form').style.display = "block";
    }
    function onlyNumberKey(evt) {
        // Only ASCII charactar in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }
    var myCarousel = document.getElementById('carouselExampleControlsNoTouching');
    myCarousel.addEventListener('slide.bs.carousel', function (e) {
        if (e.to === 0) {
            document.getElementById('walk-form').style.display = "block";
            document.getElementById('motorcycle-form').style.display = "none";
            document.getElementById('car-form').style.display = "none";
        } else if (e.to === 1) {
            document.getElementById('walk-form').style.display = "none";
            document.getElementById('motorcycle-form').style.display = "block";
            document.getElementById('car-form').style.display = "none";
        } else if (e.to === 2) {
            document.getElementById('walk-form').style.display = "none";
            document.getElementById('motorcycle-form').style.display = "none";
            document.getElementById('car-form').style.display = "block";
        }
    });
</script>
</html>



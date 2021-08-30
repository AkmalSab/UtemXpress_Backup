<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <x-head-component/>
        <style>
            #title{
                font-weight: bold;
                font-size: 30px;
            }

            #title2{
                font-size: 15px;
            }

            #service{
                border: 1px solid black;
            }

            #section1{
                background-image: url("/img/home-icon-4.png");
                height: 1000px;
                background-repeat: no-repeat;
                background-position: center;
                background-size: cover;
            }
        </style>
    </head>
    <body>
        <x-header-component/>
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <p id="title">Same-Day Delivery</p>
                        <p>The 24/7 on-demand delivery app</p>
                        <a href="{{url('/login')}}" class="btn btn-primary">Deliver Now</a>
                    </div>
                </div>
            </div>

            <div class="container mt-3 text-center">
                <div class="row g-2">
                    <div class="col-4">
                        <div class="border bg-light">
                            <i class="fas fa-building"></i><h3>Business</h3><br>
                            Faster delivery solutions for businesses of all sizes
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="border bg-light">
                            <i class="fas fa-user-friends"></i><h3>Personal</h3><br>
                            Connect easily with our delivery partners when you need them
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="border bg-light">
                            <i class="fas fa-biking"></i><h3>Driver</h3><br>
                            Enjoy the freedom to deliver for us whenever you feel like it
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-3 text-justify">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <img src="/img/home-icon-4.png" class="img img-fluid">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="row row-cols-1">
                            <div class="col mt-5" id="title2">
                                <img src="/img/clock.png" class="img img-fluid">
                                <b>24/7 Service</b><br>
                                We’ll be there for you. Same day delivery or next day delivery? It’s your call
                            </div>
                            <div class="col mt-5" id="title2">
                                <img src="/img/dollar.png" class="img img-fluid">
                                <b>Affordable</b><br>
                                Transparent pricing with no hidden costs. Pay directly through the app or make a cash payment to our delivery partner
                            </div>
                            <div class="col mt-5" id="title2">
                                <img src="/img/car.png" class="img img-fluid">
                                <b>A variety of vehicle choices</b><br>
                                Select a vehicle that is compatible with your delivery requirement
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--            end of container --}}
        </div>
        <x-footer-component/>
    </body>
</html>

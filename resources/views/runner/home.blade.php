<!DOCTYPE html>
<html lang="en">
    <head>
{{--        <meta http-equiv="refresh" content="5" id="reload">--}}
        <x-head-component/>
        <style>
            /* The switch - the box around the slider */
            .switch {
                position: relative;
                display: inline-block;
                width: 60px;
                height: 34px;
            }

            /* Hide default HTML checkbox */
            .switch input {
                opacity: 0;
                width: 0;
                height: 0;
            }

            /* The slider */
            .slider {
                position: absolute;
                cursor: pointer;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: #ccc;
                -webkit-transition: .4s;
                transition: .4s;
            }

            .slider:before {
                position: absolute;
                content: "";
                height: 26px;
                width: 26px;
                left: 4px;
                bottom: 4px;
                background-color: white;
                -webkit-transition: .4s;
                transition: .4s;
            }

            input:checked + .slider {
                background-color: #2196F3;
            }

            input:focus + .slider {
                box-shadow: 0 0 1px #2196F3;
            }

            input:checked + .slider:before {
                -webkit-transform: translateX(26px);
                -ms-transform: translateX(26px);
                transform: translateX(26px);
            }

            /* Rounded sliders */
            .slider.round {
                border-radius: 34px;
            }

            .slider.round:before {
                border-radius: 50%;
            }
        </style>
    </head>
    <body>
        <x-header-component/>

        @if($runner_details->runner_license_picture_front == null || $runner_details->runner_license_picture_back == null || $runner_vehicle_details == 0)
            <div class="container mt-3">
                <div class="row">
                    <div class="col text-center">
                        <h3>Please set up your license and vehicle details before start working</h3><br>
                        <a class="btn btn-primary" href="{{url('/runner/profile')}}">Go to Profile</a>
                    </div>
                </div>
            </div>
        @else
            <div class="container mt-3">
                <div class="row">
                    <div class="col">
                        <h1 class="text-center">Order Listing</h1>
                        <!-- Rounded switch -->
                        <label for="jobLabel" id="jobLabel">Off</label>
                        <label class="switch">
                            <input type="checkbox" id="jobSwitch">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="container mt-3" id="jobListing">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">On-demand</button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">For-Later</button>
                    </div>
                </nav>

                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        @if($availableOrderList->isEmpty())
                            <div class="container justify-content-center text-center">
                                <h3 class="mt-5">No Active On-Demand Order Currently</h3>
                            </div>
                        @else
                            @foreach($availableOrderList as $item)
                                <div class="col mt-2">
                                    <div class="list-group">
                                        @if($item->order_type == "on-demand")
                                            <a href="{{url('/runner/newOrderDetail/'.$item->order_id)}}" class="list-group-item list-group-item-action" aria-current="true" style="background-color: #0004f5; color: white;">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">#{{$item->order_id}}</h5>
                                                    <small>
                                                        {{date('d/m', strtotime($item->order_date))}} -
                                                        {{date('h:m A', strtotime($item->order_time))}}
                                                    </small>
                                                </div>
                                                <p class="mb-1">📍{{$item->order_pickup_location}}</p>
                                                <p class="mb-1">🏠 {{$item->order_dropoff_location}}</p>
                                                <div class="d-flex w-100 justify-content-between">
                                                    <small class="mb-1"></small>
                                                    <small><b>RM{{$item->order_fee}}</b></small>
                                                </div>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        @if($availableOrderList->isEmpty())
                            <div class="container justify-content-center text-center">
                                <h3 class="mt-5">No Active For-Later Order Currently</h3>
                            </div>
                        @else
                            @foreach($availableOrderList as $item)
                                <div class="col mt-2">
                                    <div class="list-group">
                                        @if($item->order_type != "on-demand")
                                            <a href="{{url('/runner/newOrderDetail/'.$item->order_id)}}" class="list-group-item list-group-item-action" aria-current="true" style="background-color: yellow;">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">#{{$item->order_id}}</h5>
                                                    <small>
                                                        {{date('d/m', strtotime($item->order_date))}} -
                                                        {{date('h:m A', strtotime($item->order_time))}}
                                                    </small>
                                                </div>
                                                <p class="mb-1">📍{{$item->order_pickup_location}}</p>
                                                <p class="mb-1">🏠 {{$item->order_dropoff_location}}</p>
                                                <div class="d-flex w-100 justify-content-between">
                                                    <small class="mb-1"></small>
                                                    <small><b>RM{{$item->order_fee}}</b></small>
                                                </div>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </body>
    <script type="text/javascript">

        var element = document.getElementsByClassName("nav-link orderlisting");
        element[0].classList.add("active");

        document.getElementById('jobListing').style.visibility = 'hidden';
        var toggle = document.getElementById('jobSwitch');

        var checked = JSON.parse(localStorage.getItem("toggleState"));
        toggle.checked = checked;

        if (toggle.checked) {
            document.getElementById('jobListing').style.visibility = 'visible';
            document.getElementById('jobLabel').innerHTML = 'On';
            localStorage.setItem('toggleState', toggle.checked);
            window.setTimeout(function () {
                window.location.reload();
            }, 10000);

        } else {
            document.getElementById('jobListing').style.visibility = 'hidden';
            document.getElementById('jobLabel').innerHTML = 'Off';
        }


        toggle.addEventListener('change', function() {
            if (this.checked) {
                document.getElementById('jobListing').style.visibility = 'visible';
                document.getElementById('jobLabel').innerHTML = 'On';
                localStorage.setItem('toggleState', toggle.checked);
                window.setTimeout(function () {
                    window.location.reload();
                }, 10000);
            } else {
                document.getElementById('jobListing').style.visibility = 'hidden';
                document.getElementById('jobLabel').innerHTML = 'Off';
                localStorage.setItem('toggleState', toggle.checked);
            }
        });
    </script>
</html>



<!DOCTYPE html>
<html lang="en">
<head>
    <x-head-component/>
</head>
<body>
<x-header-component/>
<div class="container mt-3">

    <h1 class="text-center">Active Order List</h1>

    <nav class="mt-4">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">On-Demand</a>
            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">For-Later</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            @if($activeOrder->isEmpty())
                <div class="container justify-content-center text-center">
                    <h3 class="mt-5">No Active On-Demand Order Currently</h3>
                    <a href="{{url('/staff/home/')}}" class="btn btn-primary">Back to Home</a>
                </div>
            @else
                @foreach($activeOrder as $item)
                    <div class="col">
                        <div class="list-group">
                            @if($item->order_type == "on-demand")
                                <a href="{{url('/staff/showOrderDetails/'.$item->order_id)}}" class="list-group-item list-group-item-action mt-3" aria-current="true" style="background-color: #0004f5; color: white;">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">#{{$item->order_id}}</h5>
                                        <small>
                                            {{date('d/m/y', strtotime($item->order_date))}} -
                                            {{date('g:i A', strtotime($item->order_time))}}
                                        </small>
                                    </div>
                                    <p class="mb-1">📍 {{$item->order_pickup_location}}</p>
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
            @if($activeOrder->isEmpty())
                <div class="container justify-content-center text-center">
                    <h3 class="mt-5">No Active For-Later Order Currently</h3>
                    <a href="{{url('/staff/home/')}}" class="btn btn-primary">Back to Home</a>
                </div>
            @else
                @foreach($activeOrder as $item)
                    <div class="col">
                        <div class="list-group">
                            @if($item->order_type == "for-later")
                                <a href="{{url('/staff/showOrderDetails/'.$item->order_id)}}" class="list-group-item list-group-item-action mt-3" aria-current="true" style="background-color: yellow;">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">#{{$item->order_id}}</h5>
                                        <small>
                                            {{date('d/m/y', strtotime($item->order_date))}} -
                                            {{date('g:i A', strtotime($item->order_time))}}
                                        </small>
                                    </div>
                                    <p class="mb-1">📍 {{$item->order_pickup_location}}</p>
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

<script type="text/javascript">
    var element = document.getElementsByClassName("nav-link activeorder");
    element[0].classList.add("active");

    $('#nav-tab a').on('click', function (e) {
        e.preventDefault()
        $(this).tab('show')
    })
</script>
</body>
</html>

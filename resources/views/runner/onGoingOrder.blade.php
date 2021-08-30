<!DOCTYPE html>
<html lang="en">
<head>
    <x-head-component/>
</head>
<body>
<x-header-component/>
<div class="container mt-3">
    <h1 class="text-center">On Going Order List</h1>
    @if($countOnGoingOrders <= 0)
        <div class="container justify-content-center text-center">
            <h3 class="text-center mt-5">No on going order</h3>
            <a href="{{url('/runner/home/')}}" class="btn btn-primary">Back to Home</a>
        </div>
    @else
        @foreach($onGoingOrders as $item)
            <div class="col">
                <div class="list-group mb-3">
                    @if($item->order_type == "on-demand")
                        <a href="{{url('/runner/showOnGoingOrderDetail/'.$item->order_id)}}" class="list-group-item list-group-item-action active" aria-current="true">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">#{{$item->order_id}}</h5>
                                <small>{{$item->order_date}} {{$item->order_time}}</small>
                            </div>
                            <p class="mb-1"><i class="cil-media-record"></i> {{$item->order_pickup_location}}</p>
                            <p class="mb-1"><i class="cil-location-pin"></i> {{$item->order_dropoff_location}}</p>
                            <div class="d-flex w-100 justify-content-between">
                                <small class="mb-1"></small>
                                <small><b>RM{{$item->order_fee}}</b></small>
                            </div>
                        </a>
                    @else
                        <a href="{{url('/runner/showOnGoingOrderDetail/'.$item->order_id)}}" class="list-group-item list-group-item-action" aria-current="true" style="background-color: yellow;">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">#{{$item->order_id}}</h5>
                                <small>{{$item->order_date}} {{$item->order_time}}</small>
                            </div>
                            <p class="mb-1"><i class="cil-media-record"></i> {{$item->order_pickup_location}}</p>
                            <p class="mb-1"><i class="cil-location-pin"></i> {{$item->order_dropoff_location}}</p>
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
<script>
    var element = document.getElementsByClassName("nav-link ongoingorder");
    element[0].classList.add("active");
</script>
</body>
</html>

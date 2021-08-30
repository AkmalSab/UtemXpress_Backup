<!DOCTYPE html>
<html lang="en">
<head>
    <x-head-component/>
</head>
<body>
<x-header-component/>
<div class="container mt-3">
    <h1 class="text-center">Recent Order List</h1>
    <br>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="All-tab" data-bs-toggle="tab" data-bs-target="#All" type="button" role="tab" aria-controls="home" aria-selected="true">All</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="Completed-tab" data-bs-toggle="tab" data-bs-target="#Completed" type="button" role="tab" aria-controls="profile" aria-selected="false">Completed</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="Cancelled-tab" data-bs-toggle="tab" data-bs-target="#Cancelled" type="button" role="tab" aria-controls="contact" aria-selected="false">Cancelled</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="Walk-tab" data-bs-toggle="tab" data-bs-target="#Walk" type="button" role="tab" aria-controls="contact" aria-selected="false">Walk</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="Motorcycle-tab" data-bs-toggle="tab" data-bs-target="#Motorcycle" type="button" role="tab" aria-controls="contact" aria-selected="false">Motorcycle</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="Car-tab" data-bs-toggle="tab" data-bs-target="#Car" type="button" role="tab" aria-controls="contact" aria-selected="false">Car</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="All" role="tabpanel" aria-labelledby="All-tab">
            {{--all order--}}
            @foreach($AllOrder as $item)
                <div class="tab-pane fade show active" id="All" role="tabpanel" aria-labelledby="home-tab">
                    <div class="list-group mb-3">
                        <a class="list-group-item list-group-item-action" aria-current="true" href="{{url('/student/showOrderRecord/'.$item->order_id)}}">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">#{{$item->order_id}}</h5>
                                <small> {{date('d/m/y', strtotime($item->order_date))}} - {{date('g:i A', strtotime($item->order_time))}}</small>
                            </div>
                            <p class="mb-1">📍 {{$item->order_pickup_location}} </p>
                            <p class="mb-1">🏠 {{$item->order_dropoff_location}} </p>
                            <div class="d-flex w-100 justify-content-between">
                                <small class="mb-1"></small>
                                <small><b>RM{{$item->order_fee}} </b></small>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="tab-pane fade" id="Completed" role="tabpanel" aria-labelledby="profile-tab">
            {{--completed order--}}
            @foreach($CompleteOrder as $item)
                <div class="tab-pane fade show active" id="All" role="tabpanel" aria-labelledby="home-tab">
                    <div class="list-group mb-3">
                        <a class="list-group-item list-group-item-action" aria-current="true" href="{{url('/student/showOrderRecord/'.$item->order_id)}}">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">#{{$item->order_id}}</h5>
                                <small> {{date('d/m/y', strtotime($item->order_date))}} - {{date('g:i A', strtotime($item->order_time))}}</small>
                            </div>
                            <p class="mb-1">📍 {{$item->order_pickup_location}} </p>
                            <p class="mb-1">🏠 {{$item->order_dropoff_location}} </p>
                            <div class="d-flex w-100 justify-content-between">
                                <small class="mb-1"></small>
                                <small><b>RM{{$item->order_fee}} </b></small>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="tab-pane fade" id="Cancelled" role="tabpanel" aria-labelledby="contact-tab">
            {{--cancelled order--}}
            @foreach($CancelledOrder as $item)
                <div class="tab-pane fade show active" id="All" role="tabpanel" aria-labelledby="home-tab">
                    <div class="list-group mb-3">
                        <a class="list-group-item list-group-item-action" aria-current="true" href="{{url('/student/showOrderRecord/'.$item->order_id)}}">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">#{{$item->order_id}}</h5>
                                <small> {{date('d/m/y', strtotime($item->order_date))}} - {{date('g:i A', strtotime($item->order_time))}}</small>
                            </div>
                            <p class="mb-1">📍 {{$item->order_pickup_location}} </p>
                            <p class="mb-1">🏠 {{$item->order_dropoff_location}} </p>
                            <div class="d-flex w-100 justify-content-between">
                                <small class="mb-1"></small>
                                <small><b>RM{{$item->order_fee}} </b></small>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="tab-pane fade" id="Walk" role="tabpanel" aria-labelledby="contact-tab">
            {{--Walk order--}}
            @foreach($WalkOrder as $item)
                <div class="tab-pane fade show active" id="All" role="tabpanel" aria-labelledby="home-tab">
                    <div class="list-group mb-3">
                        <a class="list-group-item list-group-item-action" aria-current="true" href="{{url('/student/showOrderRecord/'.$item->order_id)}}">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">#{{$item->order_id}}</h5>
                                <small> {{date('d/m/y', strtotime($item->order_date))}} - {{date('g:i A', strtotime($item->order_time))}}</small>
                            </div>
                            <p class="mb-1">📍 {{$item->order_pickup_location}} </p>
                            <p class="mb-1">🏠 {{$item->order_dropoff_location}} </p>
                            <div class="d-flex w-100 justify-content-between">
                                <small class="mb-1"></small>
                                <small><b>RM{{$item->order_fee}} </b></small>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="tab-pane fade" id="Motorcycle" role="tabpanel" aria-labelledby="contact-tab">
            {{--Motor order--}}
            @foreach($MotorOrder as $item)
                <div class="tab-pane fade show active" id="All" role="tabpanel" aria-labelledby="home-tab">
                    <div class="list-group mb-3">
                        <a class="list-group-item list-group-item-action" aria-current="true" href="{{url('/student/showOrderRecord/'.$item->order_id)}}">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">#{{$item->order_id}}</h5>
                                <small> {{date('d/m/y', strtotime($item->order_date))}} - {{date('g:i A', strtotime($item->order_time))}}</small>
                            </div>
                            <p class="mb-1">📍 {{$item->order_pickup_location}} </p>
                            <p class="mb-1">🏠 {{$item->order_dropoff_location}} </p>
                            <div class="d-flex w-100 justify-content-between">
                                <small class="mb-1"></small>
                                <small><b>RM{{$item->order_fee}} </b></small>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="tab-pane fade" id="Car" role="tabpanel" aria-labelledby="contact-tab">
            {{--Car order--}}
            @foreach($CarOrder as $item)
                <div class="tab-pane fade show active" id="All" role="tabpanel" aria-labelledby="home-tab">
                    <div class="list-group mb-3">
                        <a class="list-group-item list-group-item-action" aria-current="true" href="{{url('/student/showOrderRecord/'.$item->order_id)}}">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">#{{$item->order_id}}</h5>
                                <small> {{date('d/m/y', strtotime($item->order_date))}} - {{date('g:i A', strtotime($item->order_time))}}</small>
                            </div>
                            <p class="mb-1">📍 {{$item->order_pickup_location}} </p>
                            <p class="mb-1">🏠 {{$item->order_dropoff_location}} </p>
                            <div class="d-flex w-100 justify-content-between">
                                <small class="mb-1"></small>
                                <small><b>RM{{$item->order_fee}} </b></small>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    var element = document.getElementsByClassName("nav-link orderrecord");
    element[0].classList.add("active");
</script>
</body>
</html>

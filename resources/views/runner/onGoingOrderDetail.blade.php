<!DOCTYPE html>
<html lang="en">
<head>
    <x-head-component/>
</head>
<body>
<x-header-component/>
<div class="container mt-3">
    <h1 class="text-center">Order Details</h1>
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session()->has('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session()->get('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @foreach($onGoingOrderDetails as $item)
        <div class="card">
            <div class="card-header">
                Order Id: <b>{{$item->order_id}}</b><br>
                Order Type: <b>{{$item->order_type}}</b>
            </div>
            <div class="card-body">
                <h5 class="card-title">📍 Pickup: <b>{{$item->order_pickup_location}}</b></h5>
                <h5 class="card-title">🏠 Dropoff: <b>{{$item->order_dropoff_location}}</b></h5>
                @if($OrderServiceDetails->isEmpty())
                    <h5 class="card-title"><i class="fas fa-cubes"></i> Service: No Additional Service</h5>
                @else
                    <h5 class="card-title"><i class="fas fa-cubes"></i> Service: </h5>
                    @foreach($OrderServiceDetails as $items)
                        <ul class="list-group">
                            @if($items->service_name == 'Xpress Bag')
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{$items->service_name}}
                                    <span class="badge bg-primary rounded-pill"><i class="fa fa-briefcase" aria-hidden="true"></i></span>
                                </li>
                            @elseif($items->service_name == 'Buy For You')
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{$items->service_name}}
                                    <span class="badge bg-primary rounded-pill"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
                                </li>
                            @elseif($items->service_name == 'Return Trip')
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{$items->service_name}}
                                    <span class="badge bg-primary rounded-pill"><i class="fas fa-exchange-alt"></i></span>
                                </li>
                            @elseif($items->service_name == 'Door to Door')
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{$items->service_name}}
                                    <span class="badge bg-primary rounded-pill"><i class="fas fa-door-open"></i></span>
                                </li>
                            @endif
                        </ul>
                    @endforeach
                @endif
                <hr>
                <p class="card-text">
                    @if($item->vehicle_id == 1)
                        Vehicle Type: Walk/Bicycle <br>
                    @elseif($item->vehicle_id == 2)
                        Vehicle Type: Motorcycle <br>
                    @elseif($item->vehicle_id == 3)
                        Vehicle Type: Car <br>
                    @endif

                    Order Status: {{$item->order_status}} <br>
                    Order Remarks: {{$item->order_remarks}} <br>
                    Order Fee: RM{{$item->order_fee}} <br>
                </p>
                <hr>
                Receiver Name: {{$item->receiver_name}}<br>
                Receiver Telephone: {{$item->receiver_phone}}<b></b><br>
            @if($item->order_status != 'cancelled' && $item->order_status != 'waiting')
                    <hr>
                    @foreach($customerDetails as $items)
                        Customer Name: {{$items->name}}<br>
                        Customer Telephone: <b>{{$items->user_phone}}</b>
                    @endforeach
                    <hr>
                @endif

                @isset($item->user_review)
                    User Review: {{$item->user_review}}<br>
                @endisset
                @isset($item->user_rating)
                    User Rating:
                    @for ($i = 0; $i < $item->user_rating; $i++)
                        ⭐
                    @endfor
                    <br>
                @endisset
                @isset($item->runner_rating)
                    Your Rating:
                    @for ($i = 0; $i < $item->runner_rating; $i++)
                        ⭐
                    @endfor
                    <br>
                    <hr>
                @endisset

                @if($item->order_status == 'on-going')
                    <br>
                    <a href="{{url('/runner/updateOrderPickedUp/'.$item->order_id)}}" class="btn btn-success">Item Picked Up</a>
                @elseif($item->order_status == 'picked-up')
                    <br>
                    <a href="{{url('/runner/completeOrder/'.$item->order_id)}}" class="btn btn-success">Complete Order</a>
                @elseif($item->order_status == 'completed' && $item->runner_rating == '')
                    <br>
                    <h4>Review Order</h4>
                    <form method="POST" action="{{url('/runner/rateOrder/'.$item->order_id)}}">
                        @csrf
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="star5" name="rate" value="5" />
                            <label for="star5" title="text">⭐⭐⭐⭐⭐</label><br>
                            <input class="form-check-input" type="radio" id="star4" name="rate" value="4" />
                            <label for="star4" title="text">⭐⭐⭐⭐</label><br>
                            <input class="form-check-input" type="radio" id="star3" name="rate" value="3" />
                            <label for="star3" title="text">⭐⭐⭐</label><br>
                            <input class="form-check-input" type="radio" id="star2" name="rate" value="2" />
                            <label for="star2" title="text">⭐⭐</label><br>
                            <input class="form-check-input" type="radio" id="star1" name="rate" value="1" />
                            <label for="star1" title="text">⭐</label><br><br>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit Review">
                        <input type="reset" class="btn btn-warning" value="Reset">
                    </form>
                    <hr class="hrl">
                @endif
                <a href="{{url('/runner/onGoingOrder')}}" class="btn btn-primary">Back</a>
                <a href="{{url('/runner/showRoute/'.$item->order_id)}}" class="btn btn-secondary">View Route</a>                
            </div>
            <div class="card-footer text-muted">
                Order Date: {{date('d/m/y', strtotime($item->order_date))}} <br>
                Order Time: {{date('h:m A', strtotime($item->order_time))}} <br>
            </div>
        </div>
    @endforeach
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <x-head-component/>
    <meta http-equiv="refresh" content="10">
    <style>
        .yellowColor{
            color: yellow;
        }

        .hrl{
            border: 1px solid black;
            border-radius: 1px;
        }
    </style>
</head>
<body>
<x-header-component/>
<div class="container mt-3">
    <h1 class="text-center">Order Details</h1>
    @if(session()->has('cancelled'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('cancelled') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session()->has('success'))
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
    @foreach($OrderDetails as $item)
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

                    {{-- vehicle section --}}
                    @if($item->vehicle_id == 1)
                        Vehicle Type: Walk/Bicycle <br>
                    @elseif($item->vehicle_id == 2)
                        Vehicle Type: Motorcycle <br>
                    @elseif($item->vehicle_id == 3)
                        Vehicle Type: Car <br>
                    @endif

                    {{-- order section --}}
                    Order Status: {{$item->order_status}} <br>
                    Order Remarks: {{$item->order_remarks}} <br>
                    Order Fee: RM{{$item->order_fee}} <br>
                    <hr>
                    Receiver Name: {{$item->receiver_name}}<br>
                    Receiver Telephone: {{$item->receiver_phone}}<br>
                {{-- runner section --}}
                @if($item->order_status == 'waiting')
                    <br>
                    <div class="d-flex align-items-center">
                        <strong>Waiting for runner...</strong>
                        <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                    </div><br>
                @elseif($item->order_status == 'on-going' || $item->order_status == 'picked-up' || $item->order_status == 'completed')
                    <hr>
                    @isset($runnerTelephone)
                        @foreach($runnerTelephone as $items)
                            Runner Name: {{$items->name}} <br>
                            Runner Telephone: <b>{{$items->user_phone}}</b>
                            <hr>
                        @endforeach
                    @endisset
                @elseif($item->order_status == 'cancelled')
                    Runner: No runner <br>
                    <hr>
                @endif

                {{-- review section --}}
                @if($item->order_status == 'completed' && $item->user_rating == '' && $item->user_review == '')
                    <h4>Review Order</h4>
                    <form method="POST" action="{{url('/student/rateOrder/'.$item->order_id)}}">
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
                            <label for="star1" title="text">⭐</label><br>
                        </div>
                        <div class="mb-3">
                            <label for="runnerReview" class="form-label">Leave a review towards our runner:</label>
                            <textarea class="form-control" id="runnerReview" name="runnerReview" rows="3"></textarea>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit Review">
                        <input type="reset" class="btn btn-warning" value="Reset">
                    </form>
                    <hr class="hrl">
                @elseif($item->order_status == 'completed' && $item->user_rating != '')
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
                        Runner Rating:
                        @for ($i = 0; $i < $item->runner_rating; $i++)
                            ⭐
                        @endfor
                        <br>
                    @endisset
                    <hr>
                @endif
                {{-- button section --}}
                <a href="{{url('/student/activeOrder')}}" class="btn btn-primary">Back</a>
                <a href="{{url('/student/showRoute/'.$item->order_id)}}" class="btn btn-secondary">View Route</a>
                @if($item->order_status == 'on-going' || $item->order_status == 'waiting')
                    <a href="{{url('/student/cancelOrder/'.$item->order_id)}}" class="btn btn-danger">Cancel Order</a>
                @elseif($item->order_status == 'completed' && $item->favourite == '')
                    @if($isRunnerAlreadyFavourite == 0)
                        <a href="{{url('/student/addToFavourite/'.$item->runner_id.'/'.$item->order_id)}}" class="btn btn-success">Add Runner to Favourite</a>
                    @endif
                @endif
            </div>
            <div class="card-footer text-muted">
                Order Date: {{date('d/m/y', strtotime($item->order_date))}} <br>
                Order Time: {{date('g:i A', strtotime($item->order_time))}} <br>
            </div>
        </div>
    @endforeach
</div>
</body>
</html>

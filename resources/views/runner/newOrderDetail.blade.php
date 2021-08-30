<!DOCTYPE html>
<html lang="en">
<head>
    <x-head-component/>
    <meta http-equiv="refresh" content="10">
</head>
<body>
    <x-header-component/>
    <div class="container mt-3">
        <h1 class="text-center">Order Details</h1>
        @if(session()->has('error'))
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
                        <b style="color: red;">Order Tax: RM{{$percentageTaken}}</b><br>
                    </p>
                    <hr>
                    @if($item->order_status == "waiting")
                        <a href="{{url('/runner/takeOrder/'.$item->order_id)}}" class="btn btn-primary">Take Order</a>
                        <a href="{{url('/runner/showRoute/'.$item->order_id)}}" class="btn btn-secondary">View Route</a>
                    @endif
                    <a href="{{url('/runner/home')}}" class="btn btn-primary">Go Back</a>
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

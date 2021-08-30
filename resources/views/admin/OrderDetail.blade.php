<!DOCTYPE html>
<html lang="en">
<head>
    <x-head-component/>
</head>
<body>
<x-header-component/>
<div class="container">
    <h1 class="text-center">Order Details</h1>
    @isset($OrderDetailsCount)
        @if($OrderDetailsCount <= 0)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Order id not found
            </div>
            <a href="{{ url('admin/manageOrder') }}" class="btn btn-primary float-end">Back</a>
        @endif
    @endisset
    @isset($OrderDetails)
        @foreach($OrderDetails as $item)
            <div class="card">
                <div class="card-header">
                    Order Id: <b>{{$item->order_id}}</b><br>
                    Order Type: <b>{{$item->order_type}}</b>
                </div>
                <div class="card-body">
                    <h5 class="card-title">📍 Pickup: <b>{{$item->order_pickup_location}}</b></h5>
                    <h5 class="card-title">🏘️ Dropoff: <b>{{$item->order_dropoff_location}}</b></h5>
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
                    @foreach($customerDetails as $items)
                        Customer Name: {{$items->name}}<br>
                        Customer Telephone: <b>{{$items->user_phone}}</b>
                    @endforeach
                    <hr>

                    @if($item->order_status != 'cancelled')
                        @foreach($runnerTelephone as $items)
                            Runner Name: {{$items->name}}<br>
                            Runner Telephone: <b>{{$items->user_phone}}</b>
                        @endforeach
                        <hr>
                    @endif

                    @isset($item->user_review)
                        User Review: {{$item->user_review}}
                        <br>
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
                        <hr>
                    @endisset

                    <a href="{{url('/admin/showRoute/'.$item->order_id)}}" class="btn btn-secondary">View Route</a>
                    <a href="{{url('admin/manageOrder')}}" class="btn btn-primary">Back</a>
                </div>
                <div class="card-footer text-muted">
                    Order Date: {{date('d/m/y', strtotime($item->order_date))}} <br>
                    Order Time: {{date('g:i A', strtotime($item->order_time))}}
                </div>
            </div>
        @endforeach
    @endisset

</div>
</body>
</html>

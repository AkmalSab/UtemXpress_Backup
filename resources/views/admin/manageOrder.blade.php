<!DOCTYPE html>
<html lang="en">
<head>
    <x-head-component/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
</head>
<body>
<x-header-component/>
<div class="container-fluid mt-3">
    <h3 class="text-center">Order Management</h3>
    @if(session()->has('cancelled'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('cancelled') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session()->get('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="table-responsive">
        <table id="table_id" class="display">
            <thead>
            <tr>
                <th>No.</th>
                <th>Order Id</th>
                <th>Vehicle</th>
                <th>User Id</th>
                <th>Runner Id</th>
                <th>Order Status</th>
                <th>Order Date</th>
                <th>Order Time</th>
                <th>Order Type</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($Orders as $item)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$item->order_id}}</td>
                    @if($item->vehicle_id == 1)
                        <td>Walk</td>
                    @elseif($item->vehicle_id == 2)
                        <td>Motorcycle</td>
                    @elseif($item->vehicle_id == 3)
                        <td>Car</td>
                    @endif
                    <td><a class="link-secondary" href="/admin/userDetails/{{$item->id}}">{{$item->id}}</a></td>
                    <td><a class="link-secondary" href="/admin/runnerDetails/{{$item->runner_id}}">{{$item->runner_id}}</a></td>
                    <td>{{$item->order_status}}</td>
                    <td>{{$item->order_date}}</td>
                    <td>{{$item->order_time}}</td>
                    <td>{{$item->order_type}}</td>
                    @if($item->order_status == "waiting")
                        <td>
                            <a
                                class="btn btn-danger"
                                href="#"
                                data-bs-toggle="modal"
                                data-bs-target="#exampleModal"
                                data-bs-orderid="{{$item->order_id}}">
                                Cancel Order
                            </a>
                        </td>
                    @else
                        <td>
                            <a
                                class="btn btn-primary"
                                href="/admin/orderDetails/{{$item->order_id}}">
                                Details
                            </a>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order Cancellation Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p type="text" id="textConfirmation"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a id="cancelOrderLink" class="btn btn-danger">Yes!</a>
            </div>
        </div>
    </div>
</div>
<script>

    var element = document.getElementsByClassName("nav-link manageorder");
    element[0].classList.add("active");

    var exampleModal = document.getElementById('exampleModal')
    exampleModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var orderId = button.getAttribute('data-bs-orderid')
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        document.getElementById("textConfirmation").textContent = 'are you sure want to cancel this order? ['+orderId+']';
        document.getElementById("cancelOrderLink").href = '/admin/cancelOrder/'+orderId;
    })

    $(document).ready( function () {
        $('#table_id').DataTable();
    } );
</script>
</body>
</html>



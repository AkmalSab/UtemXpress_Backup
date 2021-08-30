<!DOCTYPE html>
<html lang="en">
<head>
    <x-head-component/>
    <script src=//code.jquery.com/jquery-3.5.1.min.js integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin=anonymous></script>
</head>
<body>
<x-header-component/>
<div class="container mt-3">
    <h1 class="text-center">Recent Order List</h1>
    <br>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" aria-current="page" id="allOrderTab">All</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="completedOrderTab">Completed</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="cancelledOrderTab">Cancelled</a>
        </li>
    </ul>
    <div class="col" id="orderBox">
    </div>
</div>
<script>
    var element = document.getElementsByClassName("nav-link pastorder");
    element[0].classList.add("active");

    $.ajax({  //create an ajax request to display.php
        type: "GET",
        url: "{{url('/runner/showAllOrderRecord')}}",
        success: function (data, index) {
            $("#allOrderTab").toggleClass(" active");
            data.forEach(myFunction);
            function myFunction(item, index) {
                document.getElementById("orderBox").innerHTML += '<div class="list-group mb-3">' +
                    '<a class="list-group-item list-group-item-action" aria-current="true" href="/runner/completedOrderDetail/'+ data[index]["order_id"] + '">' +
                    '<div class="d-flex w-100 justify-content-between">'+
                    '<h5 class="mb-1">#' + data[index]["order_id"] + '</h5>'+
                    '<small>' + data[index]["order_date"] + ' - ' + data[index]["order_time"] + '</small>'+
                    '</div>'+
                    '<p class="mb-1">📍' + data[index]["order_pickup_location"] + '</p>'+
                    '<p class="mb-1">🏠' + data[index]["order_dropoff_location"] + '</p>'+
                    '<div class="d-flex w-100 justify-content-between">'+
                    '<small class="mb-1"></small>'+
                    '<small><b>RM' + data[index]["order_fee"] + '</b></small>'+
                    '</div>'+
                    '</a>'+
                    '</div>';
            }
        }
    });

    $("#allOrderTab").click(function(event){
        event.preventDefault();

        $.ajax({  //create an ajax request to display.php
            type: "GET",
            url: "{{url('/runner/showAllOrderRecord')}}",
            success: function (data) {
                $("#allOrderTab").toggleClass(" active");
                $("#completedOrderTab").removeClass(" active");
                $("#cancelledOrderTab").removeClass(" active");
                document.getElementById("orderBox").innerHTML = '';
                data.forEach(myFunction);
                function myFunction(item, index) {
                    document.getElementById("orderBox").innerHTML += '<div class="list-group mb-3">' +
                        '<a class="list-group-item list-group-item-action" aria-current="true" href="/runner/completedOrderDetail/'+ data[index]["order_id"] + '">' +
                        '<div class="d-flex w-100 justify-content-between">'+
                        '<h5 class="mb-1">#' + data[index]["order_id"] + '</h5>'+
                        '<small>' + data[index]["order_date"] + ' - ' + data[index]["order_time"] + '</small>'+
                        '</div>'+
                        '<p class="mb-1">📍' + data[index]["order_pickup_location"] + '</p>'+
                        '<p class="mb-1">🏠' + data[index]["order_dropoff_location"] + '</p>'+
                        '<div class="d-flex w-100 justify-content-between">'+
                        '<small class="mb-1"></small>'+
                        '<small><b>RM' + data[index]["order_fee"] + '</b></small>'+
                        '</div>'+
                        '</a>'+
                        '</div>';
                }
            }
        });
    });

    $("#completedOrderTab").click(function(event){
        event.preventDefault();

        $.ajax({  //create an ajax request to display.php
            type: "GET",
            url: "{{url('/runner/showCompletedOrderRecord')}}",
            success: function (data) {
                $("#completedOrderTab").toggleClass(" active");
                $("#allOrderTab").removeClass(" active");
                $("#cancelledOrderTab").removeClass(" active");
                document.getElementById("orderBox").innerHTML = '';
                data.forEach(myFunction);
                function myFunction(item, index) {
                    document.getElementById("orderBox").innerHTML += '<div class="list-group mb-3">' +
                        '<a class="list-group-item list-group-item-action" aria-current="true" href="/runner/completedOrderDetail/'+ data[index]["order_id"] + '">' +
                        '<div class="d-flex w-100 justify-content-between">'+
                        '<h5 class="mb-1">#' + data[index]["order_id"] + '</h5>'+
                        '<small>' + data[index]["order_date"] + ' - ' + data[index]["order_time"] + '</small>'+
                        '</div>'+
                        '<p class="mb-1">📍' + data[index]["order_pickup_location"] + '</p>'+
                        '<p class="mb-1">🏠' + data[index]["order_dropoff_location"] + '</p>'+
                        '<div class="d-flex w-100 justify-content-between">'+
                        '<small class="mb-1"></small>'+
                        '<small><b>RM' + data[index]["order_fee"] + '</b></small>'+
                        '</div>'+
                        '</a>'+
                        '</div>';
                }
            }
        });
    });

    $("#cancelledOrderTab").click(function(event){
        event.preventDefault();

        $.ajax({  //create an ajax request to display.php
            type: "GET",
            url: "{{url('/runner/showCancelledOrderRecord')}}",
            success: function (data) {
                $("#completedOrderTab").removeClass(" active");
                $("#allOrderTab").removeClass(" active");
                $("#cancelledOrderTab").toggleClass(" active");
                document.getElementById("orderBox").innerHTML = '';
                data.forEach(myFunction);
                function myFunction(item, index) {
                    document.getElementById("orderBox").innerHTML += '<div class="list-group mb-3">' +
                        '<a class="list-group-item list-group-item-action" aria-current="true" href="/runner/completedOrderDetail/'+ data[index]["order_id"] + '">' +
                        '<div class="d-flex w-100 justify-content-between">'+
                        '<h5 class="mb-1">#' + data[index]["order_id"] + '</h5>'+
                        '<small>' + data[index]["order_date"] + ' - ' + data[index]["order_time"] + '</small>'+
                        '</div>'+
                        '<p class="mb-1">📍' + data[index]["order_pickup_location"] + '</p>'+
                        '<p class="mb-1">🏠' + data[index]["order_dropoff_location"] + '</p>'+
                        '<div class="d-flex w-100 justify-content-between">'+
                        '<small class="mb-1"></small>'+
                        '<small><b>RM' + data[index]["order_fee"] + '</b></small>'+
                        '</div>'+
                        '</a>'+
                        '</div>';
                }
            }
        });
    });
</script>
</body>
</html>

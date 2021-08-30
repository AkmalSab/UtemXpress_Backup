<!DOCTYPE html>
<html lang="en">
<head>
    <x-head-component/>
</head>
<body>
<x-header-component/>
<div class="container">
    <h1 class="text-center">Runner Details</h1>
    @isset($RunnerDetails)
        @foreach($RunnerDetails as $item)
            <div class="card">
                <div class="card-header">
                    Runner Id: <b>{{$item->id}}</b><br>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center">Personal Details</h5>
                    <hr>
                    <table class="table table-striped">
                        <tr>
                            <th>Runner Name</th>
                        </tr>
                        <tr>
                            <td>{{$item->name}}</td>
                        </tr>
                        <tr>
                            <th>Runner Ic</th>
                        </tr>
                        <tr>
                            <td>{{$item->student_nric}}</td>
                        </tr>
                        <tr>
                            <th>Runner Email</th>
                        </tr>
                        <tr>
                            <td>{{$item->email}}</td>
                        </tr>
                        <tr>
                            <th>Runner Faculty</th>
                        </tr>
                        <tr>
                            <td>{{$item->student_faculty}}</td>
                        </tr>
                        <tr>
                            <th>Runner Telephone</th>
                        </tr>
                        <tr>
                            <td>{{$item->user_phone}}</td>
                        </tr>
                        <tr>
                            <th>Runner Status</th>
                        </tr>
                        <tr>
                            <td>{{$item->student_status}}</td>
                        </tr>
                        <tr>
                            <th>Runner Image</th>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showImage">
                                    Show Personal Image
                                </button>
                                @include('admin.runnerModal')
                            </td>
                        </tr>
                        <tr>
                            <th>Runner License Front</th>
                        </tr>
                        <tr>
                            <td>
                                @if($item->runner_license_picture_front != 'None')
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showIcFront">
                                        Show License Front Image
                                    </button>
                                    @include('admin.runnerModal')
                                @else
                                    {{$item->runner_license_picture_front}}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Runner License Back</th>
                        </tr>
                        <tr>
                            <td>
                                @if($item->runner_license_picture_back != 'None')
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showIcBack">
                                        Show License Back Image
                                    </button>
                                    @include('admin.runnerModal')
                                @else
                                    {{$item->runner_license_picture_back}}
                                @endif
                            </td>
                        </tr>
                    </table>
                    @foreach($RunnerVehicleDetails as $item)
                        <h5 class="card-title text-center">Vehicle Details</h5>
                        <hr>
                        <table class="table table-striped">
                            <tr>
                                <th>Vehicle Type</th>
                            </tr>
                            <tr>
                                <td>{{$item->vehicle_type}}</td>
                            </tr>
                            <tr>
                                <th>Vehicle Plate Number</th>
                            </tr>
                            <tr>
                                <td>{{$item->vehicle_number_plate_picture}}</td>
                            </tr>
                            <tr>
                                <th>Vehicle Image</th>
                            </tr>
                            <tr>
                                <td>
                                    @if($item->vehicle_picture != 'None')
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showVehicle">
                                            Show Vehicle Image
                                        </button>
                                        @include('admin.vehicleModal')
                                    @else
                                        {{$item->vehicle_picture}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Vehicle Roadtax Image</th>
                            </tr>
                            <tr>
                                <td>
                                    @if($item->vehicle_roadtax_picture != 'None')
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showRoadtax">
                                            Show Roadtax Image
                                        </button>
                                        @include('admin.vehicleModal')
                                    @else
                                        {{$item->vehicle_roadtax_picture}}
                                    @endif
                                </td>
                            </tr>
                        </table>
                    @endforeach
                    <a href="{{ url()->previous() }}" class="col-12 btn btn-primary">Back</a>
                </div>
                <div class="card-footer text-muted">
                    Joined Date: {{$item->created_at}} <br>
                </div>
            </div>
        @endforeach
    @endisset

    <br><br>
</div>
</body>
</html>

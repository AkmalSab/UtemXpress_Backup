<!DOCTYPE html>
<html lang="en">
<head>
    <x-head-component/>
</head>
<body>
<x-header-component/>
<div class="container mt-3">
    <h1 class="text-center">Runner Details</h1>
    @foreach($runnerDetails as $item)
        <div class="card">
            <div class="card-header">
                Runner Id: <b>{{$item->runner_id}}</b><br>
            </div>
            <div class="card-body">
                <h5 class="card-title text-center"><i class="far fa-id-card"></i>  Personal Details</h5>
                <hr>
                <table class="table table-striped">
                    <tr>
                        <th>Runner Name</th>
                    </tr>
                    <tr>
                        <td>{{$item->student_name}}</td>
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
                        <td>{{$item->student_email}}</td>
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
                </table>
                <h5 class="card-title text-center"><i class="fas fa-car"></i>  Vehicle Details</h5>
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
                            @if($item->vehicle_picture == 'None')
                                {{$item->vehicle_picture}}
                            @else
                                <img src="{{$item->vehicle_picture}}" width="50%" height="50%" class="rounded img-fluid">
                            @endif
                        </td>
                    </tr>
                </table>
                <p class="card-text">

                </p>
                <a href="{{ url()->previous() }}" class="col-12 btn btn-primary">Back</a>
            </div>
            <div class="card-footer text-muted">
                Joined Date: {{date('d/m/y g:i A', strtotime($item->created_at))}} <br>
                Runner Status: {{$item->student_status}} <br>
            </div>
        </div>
    @endforeach
    <br><br>
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <x-head-component/>
</head>
<body>
<x-header-component/>
<div class="container">
    <h1 class="text-center">Users Details</h1>
    @isset($StaffDetails)
        @foreach($StaffDetails as $item)
            <div class="card">
                <div class="card-header">
                    User Id: <b>{{$item->id}}</b><br>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center">Personal Details</h5>
                    <hr>
                    <table class="table table-striped">
                        <tr>
                            <th>User Name</th>
                        </tr>
                        <tr>
                            <td>{{$item->name}}</td>
                        </tr>
                        <tr>
                            <th>User Ic</th>
                        </tr>
                        <tr>
                            <td>{{$item->staff_nric}}</td>
                        </tr>
                        <tr>
                            <th>User Email</th>
                        </tr>
                        <tr>
                            <td>{{$item->email}}</td>
                        </tr>
                        <tr>
                            <th>User Faculty</th>
                        </tr>
                        <tr>
                            <td>{{$item->staff_faculty}}</td>
                        </tr>
                        <tr>
                            <th>User Division</th>
                        </tr>
                        <tr>
                            <td>{{$item->staff_division}}</td>
                        </tr>
                        <tr>
                            <th>User Designation</th>
                        </tr>
                        <tr>
                            <td>{{$item->staff_designation}}</td>
                        </tr>
                        <tr>
                            <th>User Telephone</th>
                        </tr>
                        <tr>
                            <td>{{$item->user_phone}}</td>
                        </tr>
                        <tr>
                            <th>User Image</th>
                        </tr>
                        <tr>
                            <td>
                                @if($item->user_picture != '')
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showImage">
                                        Show Personal Image
                                    </button>
                                    @include('admin.userModal')
                                @else
                                    Not Set
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>User Ic Front</th>
                        </tr>
                        <tr>
                            <td>
                                @if($item->user_nric_picture_front != '')
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showIcFront">
                                        Show Ic Front Image
                                    </button>
                                @include('admin.userModal')
                                @else
                                    Not Set
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>User Ic Back</th>
                        </tr>
                        <tr>
                            <td>
                                @if($item->user_nric_picture_back != '')
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showIcBack">
                                        Show Ic Back Image
                                    </button>
                                    @include('admin.userModal')
                                @else
                                    Not Set
                                @endif
                            </td>
                        </tr>
                    </table>
                    <p class="card-text">

                    </p>
                    <a href="{{ url()->previous() }}" class="col-12 btn btn-primary">Back</a>
                </div>
                <div class="card-footer text-muted">
                    Joined Date: {{date('d/m/Y g:i A', strtotime($item->created_at))}}<br>
                    Staff Status: {{$item->staff_status}} <br>
                </div>
            </div>
        @endforeach
    @endisset
    @isset($UserDetails)
        @foreach($UserDetails as $item)
            <div class="card">
                <div class="card-header">
                    User Id: <b>{{$item->id}}</b><br>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center">Personal Details</h5>
                    <hr>
                    <table class="table table-striped">
                        <tr>
                            <th>User Name</th>
                        </tr>
                        <tr>
                            <td>{{$item->name}}</td>
                        </tr>
                        <tr>
                            <th>User Ic</th>
                        </tr>
                        <tr>
                            <td>{{$item->student_nric}}</td>
                        </tr>
                        <tr>
                            <th>User Email</th>
                        </tr>
                        <tr>
                            <td>{{$item->email}}</td>
                        </tr>
                        <tr>
                            <th>User Faculty</th>
                        </tr>
                        <tr>
                            <td>{{$item->student_faculty}}</td>
                        </tr>
                        <tr>
                            <th>User Telephone</th>
                        </tr>
                        <tr>
                            <td>{{$item->user_phone}}</td>
                        </tr>
                        <tr>
                            <th>User Image</th>
                        </tr>
                        <tr>
                            <td>
                                @if($item->user_picture != '')
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showImage">
                                        Show Personal Image
                                    </button>
                                    @include('admin.userModal')
                                @else
                                    Not Set
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>User Ic Front</th>
                        </tr>
                        <tr>
                            <td>
                                @if($item->user_nric_picture_front != '')
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showIcFront">
                                        Show Ic Front Image
                                    </button>
                                    @include('admin.userModal')
                                @else
                                    Not Set
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>User Ic Back</th>
                        </tr>
                        <tr>
                            <td>
                                @if($item->user_nric_picture_back != '')
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showIcBack">
                                        Show Ic Back Image
                                    </button>
                                    @include('admin.userModal')
                                @else
                                    Not Set
                                @endif
                            </td>
                        </tr>
                    </table>
                    <p class="card-text">

                    </p>
                    <a href="{{ url()->previous() }}" class="col-12 btn btn-primary">Back</a>
                </div>
                <div class="card-footer text-muted">
                    Joined Date: {{date('d/m/Y g:i A', strtotime($item->created_at))}}<br>
                    Student Status: {{$item->student_status}} <br>
                </div>
            </div>
        @endforeach
    @endisset

    <br><br>
</div>
</body>
</html>

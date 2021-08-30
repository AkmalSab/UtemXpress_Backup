<!DOCTYPE html>
<html lang="en">
<head>
    <x-head-component/>
</head>
<body>
<x-header-component/>
<div class="container">
    <h1 class="text-center">Admin Details</h1>
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
                            <th>Admin Name</th>
                        </tr>
                        <tr>
                            <td>{{$item->name}}</td>
                        </tr>
                        <tr>
                            <th>Admin Ic</th>
                        </tr>
                        <tr>
                            <td>{{$item->admin_nric}}</td>
                        </tr>
                        <tr>
                            <th>Admin Email</th>
                        </tr>
                        <tr>
                            <td>{{$item->email}}</td>
                        </tr>
                        <tr>
                            <th>Admin Telephone</th>
                        </tr>
                        <tr>
                            <td>{{$item->user_phone}}</td>
                        </tr>
                        <tr>
                            <th>Admin Image</th>
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
                            <th>Admin Ic Front</th>
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
                            <th>Admin Ic Back</th>
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
                    <a href="{{ url()->previous() }}" class="col-12 btn btn-primary">Back</a>
                </div>
                <div class="card-footer text-muted">
                    Joined Date: {{$item->created_at}} <br>
                    Runner Status: {{$item->admin_status}} <br>
                </div>
            </div>
        @endforeach
    @endisset

    <br><br>
</div>
</body>
</html>

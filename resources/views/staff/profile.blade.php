<!DOCTYPE html>
<html lang="en">
<head>
    <x-head-component/>
</head>
<body>
<x-header-component/>
<div class="row mt-5">
    <div class="col">
        <div class="container justify-content-center">
            <div class="card align-content-center ">
                <div class="card-body">
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <h2 class="card-title"><i class="fas fa-user-circle"></i> Profile</h2>
                    <h6 class="card-subtitle mb-2 text-muted">Staff's personal information</h6>
                    <table class="table">
                        <tbody>
                        <tr>
                            <th scope="row">Name:</th>
                            <td>{{Auth::user()->name}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Email:</th>
                            @if (Auth::user()->hasVerifiedEmail())
                                <td>{{Auth::user()->email}} <span class="badge bg-success" style="font-size: 100%;">Verified</span></td>
                            @else
                                <td>{{Auth::user()->email}} <span class="badge bg-danger">Not Verified</span></td>
                            @endif
                        </tr>
                        <tr>
                            <th scope="row">Phone:</th>
                            <td>{{Auth::user()->user_phone}}</td>
                        </tr>
                        @foreach($nric as $items)
                            @if($items->user_picture == "")
                                <tr>
                                    <th scope="row">Personal Image:</th>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addImage">
                                            Add Personal Image
                                        </button>
                                        @include('staff.addIc')
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <th scope="row">Personal Image:</th>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showImage">
                                            Show Personal Image
                                        </button>
                                        @include('staff.addIc')
                                    </td>
                                </tr>
                            @endif
                            @if($items->user_nric_picture_front == "")
                                <tr>
                                    <th scope="row">IC Front:</th>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addIcImage">
                                            Add IC Image
                                        </button>
                                        @include('staff.addIc')
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <th scope="row">IC Front:</th>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showIcFront">
                                            Show IC Picture Front
                                        </button>
                                        @include('staff.addIc')
                                    </td>
                                </tr>
                            @endif
                            @if($items->user_nric_picture_back == "")
                                <tr>
                                    <th scope="row">IC Back:</th>
                                    <td>
                                        Not added yet
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <th scope="row">IC Back:</th>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showIcBack">
                                            Show IC Picture Back
                                        </button>
                                        @include('staff.addIc')
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var element = document.getElementsByClassName("nav-link userprofile");
    element[0].classList.add("active");
</script>
</body>
</html>


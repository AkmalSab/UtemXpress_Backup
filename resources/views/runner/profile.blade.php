<!DOCTYPE html>
<html lang="en">
<head>
    <x-head-component/>
</head>
<body>
    <x-header-component/>
    {{--personal section--}}
    <div class="row">
        <div class="col">
            <div class="container justify-content-center mt-3">
                <h1 class="text-center">Profile</h1>
                @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session()->get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card align-content-center ">
                    <div class="card-body">
                        <h2 class="card-title"><i class="fas fa-user-alt"></i> Profile</h2>
                        <h6 class="card-subtitle mb-2 text-muted">Runner's personal information</h6>
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
                            <tr>
                                <th scope="row">Image:</th>
                                @if(Auth::user()->user_picture == null)
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addImage">
                                            Add Personal Image
                                        </button>
                                        @include('runner.addLicense')
                                    </td>
                                @else
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showImage">
                                            Show Personal Image
                                        </button>
                                        @include('runner.addLicense')
                                    </td>
                                @endif

                            </tr>
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
    {{--personal section--}}
    {{--vehicle section--}}
    <div class="row mt-5">
        <div class="col">
            <div class="container justify-content-center">
                <div class="card align-content-center ">
                    <div class="card-body">
                        <h2 class="card-title"><i class="fas fa-car"></i> Vehicle</h2>
                        <h6 class="card-subtitle mb-2 text-muted">Runner's vehicle information</h6>
                        @if($vehicle == 1)
                            <table class="table">
                                <tbody>
                                @foreach($vehicledDetails as $items)
                                    <tr>
                                        <th scope="row">Type:</th>
                                        <td>{{$items->vehicle_type}}</td>
                                    </tr>
                                    @if($items->vehicle_number_plate_picture != 'None')
                                        <tr>
                                            <th scope="row">Plate Number:</th>
                                            <td>{{$items->vehicle_number_plate_picture}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Image:</th>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#VehiclestaticBackdrop">
                                                    Show Vehicle Image
                                                </button>
                                                @include('runner.addVehicle')
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Roadtax:</th>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#RoadtaxstaticBackdrop">
                                                    Show Roadtax Image
                                                </button>
                                                @include('runner.addVehicle')
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#UpdateVehiclestaticBackdrop">
                                Update Vehicle
                            </button>
                            @include('runner.addVehicle')
                        @elseif($vehicle == 0)
                        <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                Add Vehicle
                            </button>
                            @include('runner.addVehicle')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--vehicle section--}}
    {{--license section--}}
    @foreach($vehicledDetails as $items)
        @if($items->vehicle_type != "Walk / Bicycle")
            {{--license section--}}
            <div class="row mt-5">
                <div class="col">
                    <div class="container justify-content-center">
                        <div class="card align-content-center ">
                            <div class="card-body">
                                <h2 class="card-title"><i class="far fa-id-card"></i> License</h2>
                                <h6 class="card-subtitle mb-2 text-muted">Runner's license information</h6>
                                @foreach($license as $LicenseItems)
                                    @if($LicenseItems->runner_license_picture_front == "None" || $LicenseItems->runner_license_picture_front == null)
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLicensestaticBackdrop">
                                            Add License
                                        </button>
                                        @include('runner.addLicense')
                                    @else
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <th scope="row">License Front Image:</th>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#LicenseFrontstaticBackdrop">
                                                        Show License Front
                                                    </button>
                                                    @include('runner.addLicense')
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">License Back Image:</th>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#LicenseBackstaticBackdrop">
                                                        Show License Back
                                                    </button>
                                                    @include('runner.addLicense')
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#LicenseUpdatestaticBackdrop">
                                            Update License
                                        </button>
                                        @include('runner.addLicense')
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--license section--}}
        @endif
    @endforeach
    {{--license section--}}

<script>
    var element = document.getElementsByClassName("nav-link runnerprofile");
    element[0].classList.add("active");
</script>
</body>
</html>

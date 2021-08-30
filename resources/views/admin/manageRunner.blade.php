<!DOCTYPE html>
<html lang="en">
<head>
    <x-head-component/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
</head>
<body>
<x-header-component/>
<div class="container mt-3">
    <h3 class="text-center">Runner Management</h3>
    @if(session()->has('deactivated'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('deactivated') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session()->has('activated'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('activated') }}
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
                <th>User Id</th>
                <th>Email</th>
                <th>Name</th>
                <th>Telephone</th>
                <th>Status</th>
                <th>Action</th>
                <th>Details</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($Users as $item)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$item->id}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->user_phone}}</td>
                    @if($item->user_status == "AVAILABLE")
                        <td>{{$item->user_status}}</td>
                        <td>
                            <a
                                class="btn btn-danger"
                                href="#"
                                data-bs-toggle="modal"
                                data-bs-target="#exampleModal"
                                data-bs-userid="{{$item->id}}"
                                data-bs-name="{{$item->name}}">
                                Deactivate
                            </a>
                        </td>
                    @else
                        <td>{{$item->user_status}}</td>
                        <td>
                            <a
                                class="btn btn-success"
                                href="#"
                                data-bs-toggle="modal"
                                data-bs-target="#exampleModal2"
                                data-bs-userid="{{$item->id}}"
                                data-bs-name="{{$item->name}}">
                                Activate
                            </a>
                        </td>
                    @endif
                    <td>
                        <a
                            class="btn btn-secondary"
                            href="{{url('/admin/runnerDetails2/'.$item->id)}}">
                            Details
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

{{--deactivate confirmation modal--}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Deactivate Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p type="text" id="textConfirmation"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a id="deactivateLink" class="btn btn-danger">Deactivate!</a>
            </div>
        </div>
    </div>
</div>

{{--activate confirmation modal--}}
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Activate Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p type="text" id="textConfirmation2"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a id="activateLink" class="btn btn-success">Activate!</a>
            </div>
        </div>
    </div>
</div>
<script>

    var element = document.getElementsByClassName("nav-link managerunner");
    element[0].classList.add("active");

    var exampleModal = document.getElementById('exampleModal')
    exampleModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var userId = button.getAttribute('data-bs-userid')
        var userName = button.getAttribute('data-bs-name')
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        document.getElementById("textConfirmation").textContent = 'are you sure want to deactivate this user? ['+userName+']';
        document.getElementById("deactivateLink").href = '/admin/deactivateUser/'+userId;
    })

    var exampleModal2 = document.getElementById('exampleModal2')
    exampleModal2.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget
        var userId = button.getAttribute('data-bs-userid')
        var userName = button.getAttribute('data-bs-name')
        document.getElementById("textConfirmation2").textContent = 'are you sure want to re-activate this user? ['+userName+']';
        document.getElementById("activateLink").href = '/admin/activateUser/'+userId;
    })

    $(document).ready( function () {
        $('#table_id').DataTable();
    } );
</script>
</body>
</html>



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
    <h3 class="text-center">Admin Management</h3>

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
    @if(session()->has('goodinfo'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('goodinfo') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session()->has('badinfo'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session()->get('badinfo') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="container">
        <a href="#"
           class="btn btn-primary"
           data-bs-toggle="modal"
           data-bs-target="#exampleModal3"
        >Add new Admin
        </a>
    </div>
    <br>
    <div class="table-responsive">
        <table id="table_id" class="display">
            <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Email</th>
                <th>IC number</th>
                <th>Status</th>
                <th>created at</th>
                <th>Action</th>
                @if($userRoles->role_id == 4)
                    <th>Details</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach ($admin as $item)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$item->admin_name}}</td>
                    <td>{{$item->admin_email}}</td>
                    <td>{{$item->admin_nric}}</td>
                    <td>{{$item->admin_status}}</td>
                    <td>{{$item->created_at}}</td>
                    @if($userRoles->role_id == 4)
                        @if($item->admin_status == 'AVAILABLE' && $item->admin_email != Auth::user()->email)
                            <td>
                                <a
                                    class="btn btn-danger"
                                    href="#"
                                    data-bs-toggle="modal"
                                    data-bs-target="#exampleModal"
                                    data-bs-userid="{{$item->admin_email}}"
                                    data-bs-name="{{$item->admin_name}}">
                                    Deactivate
                                </a>
                            </td>
                        @elseif($item->admin_status == 'UNAVAILABLE')
                            <td>
                                <a
                                    class="btn btn-success"
                                    href="#"
                                    data-bs-toggle="modal"
                                    data-bs-target="#exampleModal2"
                                    data-bs-userid="{{$item->admin_email}}"
                                    data-bs-name="{{$item->admin_name}}">
                                    Activate
                                </a>
                            </td>
                        @else
                            <td>

                            </td>
                        @endif
                        <td>
                            <a
                                class="btn btn-secondary"
                                href="{{url('/admin/adminDetails/'.$item->admin_email)}}">
                                Details
                            </a>
                        </td>
                    @elseif($userRoles->role_id == 5)
                        <td>
                            <a
                                class="btn btn-secondary"
                                href="{{url('/admin/adminDetails/'.$item->admin_email)}}">
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
<br>
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
{{--add new admin modal--}}
<div class="modal fade" id="exampleModal3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{url('/admin/addNewAdmin')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="newAdminEmail" name="admin_email" aria-describedby="emailHelp" required>
                        <div id="emailHelp" class="form-text">New admin's email</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail2" class="form-label">Identification Card Number(IC)</label>
                        <input type="text" class="form-control" id="newAdminIc" name="admin_nric" aria-describedby="emailHelp" maxlength="12" required>
                        <div id="icHelp" class="form-text">New admin's ic</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail2" class="form-label">Name</label>
                        <input type="text" class="form-control" id="newAdminName" name="admin_name" aria-describedby="emailHelp" oninput="this.value = this.value.toUpperCase()" required>
                        <div id="nameHelp" class="form-text">New admin's name</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<script>

    var element = document.getElementsByClassName("nav-link manageadmin");
    element[0].classList.add("active");

    $(document).ready(function(){
        $("#newAdminName").keydown(function(event){
            var inputValue = event.which;
            // allow letters and whitespaces only.
            if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0 && inputValue != 8)) {
                event.preventDefault();
            }

            $(this).val($(this).val().toUpperCase());
        });
    });

    $(document).ready(function () {
        //called when key is pressed in textbox
        $("#newAdminIc").keypress(function (e) {
            //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                //display error message
                $("#icHelp").html("Digits Only").show();
                return false;
            }
        });
    });

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
        document.getElementById("textConfirmation").textContent = 'are you sure want to deactivate this admin? ['+userName+']';
        document.getElementById("deactivateLink").href = '/admin/deactivateAdmin/'+userId;
    })

    var exampleModal2 = document.getElementById('exampleModal2')
    exampleModal2.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget
        var userId = button.getAttribute('data-bs-userid')
        var userName = button.getAttribute('data-bs-name')
        document.getElementById("textConfirmation2").textContent = 'are you sure want to re-activate this admin? ['+userName+']';
        document.getElementById("activateLink").href = '/admin/activateAdmin/'+userId;
    })


    $(document).ready( function () {
        $('#table_id').DataTable();
    } );
</script>
</body>
</html>



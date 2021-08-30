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
    <h3 class="text-center">User Management</h3>

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
           data-bs-target="#addNewStudent"
        >Add new Student
        </a>

        <a href="#"
           class="btn btn-primary"
           data-bs-toggle="modal"
           data-bs-target="#addNewStaff"
        >Add new Staff
        </a>
    </div>
    <br>
    <div class="table-responsive">
        <table id="table_id" class="display">
            <thead>
            <tr>
                <th>No.</th>
                <th>User Id</th>
                <th>Email</th>
                <th>Name</th>
                <th>Telephone</th>
                <th>Role</th>
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
                    @if($item->role_id == 1)
                        <td>
                            Student
                        </td>
                    @endif
                    @if($item->role_id == 2)
                        <td>
                            Staff
                        </td>
                    @endif
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
                            href="{{url('/admin/userDetails/'.$item->id)}}">
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

{{--modal add new student--}}
<div class="modal fade" id="addNewStudent" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{url('/admin/addNewStudent')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="newStudentEmail" name="student_email" aria-describedby="emailHelp" required>
                        <div id="emailHelp" class="form-text">New student's email</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail2" class="form-label">Identification Card Number(IC)</label>
                        <input type="text" class="form-control" id="newStudentIc" name="student_nric" aria-describedby="emailHelp" maxlength="12" required>
                        <div id="icHelp" class="form-text">New student's ic</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail2" class="form-label">Name</label>
                        <input type="text" class="form-control" id="newStudentName" name="student_name" aria-describedby="emailHelp" oninput="this.value = this.value.toUpperCase()" required>
                        <div id="nameHelp" class="form-text">New student's name</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail2" class="form-label">Faculty</label>
                        <select class="form-select" aria-label="Default select example" name="student_faculty" required>
                            <option value="FAKULTI KEJURUTERAAN ELEKTRONIK DAN KEJURUTERAAN KOMPUTER">FKEKK</option>
                            <option value="FAKULTI KEJURUTERAAN ELEKTRIK">FKE</option>
                            <option value="FAKULTI KEJURUTERAAN MEKANIKAL">FKM</option>
                            <option value="FAKULTI KEJURUTERAAN PEMBUATAN">FKP</option>
                            <option value="FAKULTI TEKNOLOGI MAKLUMAT DAN KOMUNIKASI">FTMK</option>
                            <option value="FAKULTI PENGURUSAN TEKNOLOGI DAN TEKNOUSAHAWANAN">FPTT</option>
                            <option value="FAKULTI TEKNOLOGI KEJURUTERAAN ELEKTRIK DAN ELEKTRONIK">FTKEE</option>
                            <option value="FAKULTI TEKNOLOGI KEJURUTERAAN MEKANIKAL DAN PEMBUATAN">FTKMP</option>
                        </select>
                        <div id="nameHelp" class="form-text">New student's faculty</div>
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

{{--modal add new staff--}}
<div class="modal fade" id="addNewStaff" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Staff</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{url('/admin/addNewStaff')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="newStaffEmail" name="staff_email" aria-describedby="emailHelp" required>
                        <div id="emailHelp" class="form-text">New staff's email</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail2" class="form-label">Identification Card Number(IC)</label>
                        <input type="text" class="form-control" id="newStaffIc" name="staff_nric" aria-describedby="emailHelp" maxlength="12" required>
                        <div id="icHelp" class="form-text">New staff's ic</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail2" class="form-label">Name</label>
                        <input type="text" class="form-control" id="newStaffName" name="staff_name" aria-describedby="emailHelp" oninput="this.value = this.value.toUpperCase()" required>
                        <div id="nameHelp" class="form-text">New staff's name</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail2" class="form-label">Designation</label>
                        <input type="text" class="form-control" id="newStaffDesignation" name="staff_designation" aria-describedby="emailHelp" style="text-transform:uppercase;" required>
                        <div id="nameHelp" class="form-text">New staff's designation</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail2" class="form-label">Faculty</label>
                        <select class="form-select" aria-label="Default select example" name="staff_faculty" required>
                            <option value="FAKULTI KEJURUTERAAN ELEKTRONIK DAN KEJURUTERAAN KOMPUTER">FKEKK</option>
                            <option value="FAKULTI KEJURUTERAAN ELEKTRIK">FKE</option>
                            <option value="FAKULTI KEJURUTERAAN MEKANIKAL">FKM</option>
                            <option value="FAKULTI KEJURUTERAAN PEMBUATAN">FKP</option>
                            <option value="FAKULTI TEKNOLOGI MAKLUMAT DAN KOMUNIKASI">FTMK</option>
                            <option value="FAKULTI PENGURUSAN TEKNOLOGI DAN TEKNOUSAHAWANAN">FPTT</option>
                            <option value="FAKULTI TEKNOLOGI KEJURUTERAAN ELEKTRIK DAN ELEKTRONIK">FTKEE</option>
                            <option value="FAKULTI TEKNOLOGI KEJURUTERAAN MEKANIKAL DAN PEMBUATAN">FTKMP</option>
                        </select>
                        <div id="nameHelp" class="form-text">New staff's name</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail2" class="form-label">Division</label>
                        <input type="text" class="form-control" id="newStaffFaculty" name="staff_division" aria-describedby="emailHelp" style="text-transform:uppercase;" required>
                        <div id="nameHelp" class="form-text">New staff's division</div>
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

    var element = document.getElementsByClassName("nav-link manageuser");
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



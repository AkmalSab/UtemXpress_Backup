<!DOCTYPE html>
<html lang="en">
    <head>
        <x-head-component/>
    </head>
    <body>
        <x-header-component/>
        <div class="container mt-3">
            <h1 class="text-center">Register</h1>
            @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session()->get('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3">
                    <label for="UserName" class="form-label">Register As:</label>
                    <select class="form-select @error('role_id') is-invalid @enderror" name="role_id" aria-label="Default select example" required>
                        <option value="1">User (Student)</option>
                        <option value="2">User (Staff)</option>
                        <option value="3">Runner (Student)</option>
                        <option value="5">Admin</option>
                    </select>
                    @error('role_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                  <label for="UserEmailAddress" class="form-label">UTeM Email Address:</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="@student.utem.edu.my / @utem.edu.my" required>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="UserPhone" class="form-label">Phone Number:</label>
                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="UserPhone" id="UserPhone" placeholder="011XXXXXXX" required minlength="10" maxlength="12" onkeypress="return onlyNumberKey(event)">
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                  <label for="UserPassword" class="form-label">Password:</label>
                  <input type="password" class="form-control @error('password') is-invalid @enderror" id="UserPassword" name="password" required onkeyup="checkPassword()">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  <input type="checkbox" class="form-check-input" onclick="showPassword()"> Show Password
                  <span id = "message"></span>
                </div>
                <div class="mb-3">
                    <label for="UserConfirmPassword" class="form-label">Confirm Password:</label>
                    <input type="password" class="form-control" name="password_confirmation" id="UserConfirmPassword" required onkeyup="checkConfirmPassword()">
                    <input type="checkbox" class="form-check-input" onclick="showConfirmPassword()"> Show Confirm Password
                    <span id = "message2"></span>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <button type="submit" id="registerUser" class="btn btn-primary col-12">Register</button>
                    </div>
                    <br><br>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <button type="reset" class="btn btn-warning col-12">Reset</button>
                    </div>
                </div>
              </form>
              <p class="text-center mt-3">Already have an account? <a href="{{ route('login') }}">Log in here.</a></p>
        </div>

        <script>
            function showPassword() {
                var x = document.getElementById("UserPassword");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }
            function showConfirmPassword() {
                var y = document.getElementById("UserConfirmPassword");
                if (y.type === "password") {
                    y.type = "text";
                } else {
                    y.type = "password";
                }
            }
            function onlyNumberKey(evt) {
                // Only ASCII charactar in that range allowed
                var ASCIICode = (evt.which) ? evt.which : evt.keyCode
                if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
                    return false;
                return true;
            }
            function checkPassword() {
                var pass = document.getElementById("UserPassword").value;
                var confirm = document.getElementById("UserConfirmPassword").value;
                if(pass.length < 8){
                    document.getElementById("message").innerHTML = "Password length must be atleast 8 characters";
                    document.getElementById("message").style.color = "red";
                    document.getElementById("registerUser").disabled = true;
                    return false;
                }
                else{
                    document.getElementById("message").innerHTML = "OK";
                    document.getElementById("message").style.color = "green";
                    document.getElementById("registerUser").disabled = false;
                    return true;
                }

            }
            function checkConfirmPassword() {
                var pass = document.getElementById("UserPassword").value;
                var confirm = document.getElementById("UserConfirmPassword").value;
                if(confirm != pass){
                    document.getElementById("message2").innerHTML = "Confirm Password are not matched with password";
                    document.getElementById("message2").style.color = "red";
                    document.getElementById("registerUser").disabled = true;
                    return false;
                }
                else{
                    document.getElementById("message2").innerHTML = "Matched";
                    document.getElementById("message2").style.color = "green";
                    document.getElementById("registerUser").disabled = false;
                    return true;
                }
            }
        </script>
    </body>
</html>

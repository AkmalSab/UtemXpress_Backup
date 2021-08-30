<!DOCTYPE html>
<html lang="en">
    <head>
        <x-head-component/>
    </head>
    <body>
        <x-header-component/>
        <div class="container mt-3">
            <h1 class="text-center">Login</h1>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                  <label for="UserEmailAddress" class="form-label">UTeM Email Address</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" aria-describedby="emailHelp" placeholder="@student.utem.edu.my / @utem.edu.my">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="mb-3">
                  <label for="UserPassword" class="form-label">Password</label>
                  <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                    <p class="float-end mt-3">Forgot Password ? <a href="{{ route('password.request') }}">Reset here</a></p>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="mb-3 form-check">
                  <input type="checkbox" class="form-check-input" id="showPassword" name="showPassword" onclick="displayPass()">Show Password
                </div>
                <div class="mb-3 form-check">
                    <input class="form-check-input" type="checkbox" value="true" id="runnerRoleDetermine" name="runnerRoleDetermine">
                    <label class="form-check-label" for="flexCheckDefault">
                        I am a runner
                    </label>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <button type="submit" class="btn btn-primary col-12">Log in</button>
                    </div>
                    <br><br>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <button type="reset" class="btn btn-warning col-12">Reset</button>
                    </div>
                </div>
              </form>
              <p class="text-center mt-3">New to UTeM-Xpress ? <a href="{{ route('register') }}">Create an account</a></p>
        </div>
    </body>
    <script>

        function displayPass() {
            var x = document.getElementById("password");
            var y = document.getElementById("showPassword");

            if(y.checked == true){
                if (x.type === "password") {
                    x.type = "text";
                }
                else {
                    x.type = "password";
                }
            }else{
                x.type = "password";
            }
        }
    </script>
</html>

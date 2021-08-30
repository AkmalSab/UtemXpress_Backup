<!DOCTYPE html>
<html lang="en">
    <head>
        <x-head-component/>
    </head>
    <body>
        <x-header-component/>

        <div class="container mt-5">
            <div class="card">
                <div class="card-header">
                    Confirm your password to enable 2 Factor Authentication
                </div>
                <div class="card-body">
                  <h5 class="card-title">Enter your password</h5>
                  <p class="card-text"></p>
                  <form method="POST" action="{{ url('user/confirm-password') }}">
                        @csrf
                        <div class="form-group mb-4">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="***********">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <input name="login" id="login" class="btn btn-primary mb-4" type="submit" value="Confirm">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

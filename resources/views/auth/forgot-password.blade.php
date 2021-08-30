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
                    Reset Password
                </div>
                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{session('status')}}
                        </div>
                    @endif
                    <h5 class="card-title">User Reset Password Request!</h5>
                    <p class="card-text">Please insert your email to be sent the reset password link</p>
                    <form method="POST" action="{{ route('password.request') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email address">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <input name="login" id="login" class="btn btn-primary mt-2" type="submit" value="Submit">
                    </form>
                    <p class="mt-2">Don't have an account? <a href="{{ route('register') }}" class="text-reset">Register here</a></p>
                </div>
            </div>
        </div>
    </body>
</html>

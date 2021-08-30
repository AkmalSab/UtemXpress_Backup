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
                    Reset Password Requisition
                </div>
                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{session('status')}}
                        </div>
                    @endif
                    <h5 class="card-title">Let's create a new password!</h5>
                    <p class="card-text">Please insert your new password & confirm password for your account.</p>
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{$request->route('token')}}">
                        <div class="form-group mb-4">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{$request->email}}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="password" class="sr-only">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="password" class="sr-only">Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password">
                        </div>
                        <input name="login" id="login" class="btn btn-primary mb-4" type="submit" value="Update Password">
                    </form>
                    <p class="mt-2">Don't have an account? <a href="{{ route('register') }}">Create here</a></p>
                </div>
            </div>
        </div>
    </body>
</html>

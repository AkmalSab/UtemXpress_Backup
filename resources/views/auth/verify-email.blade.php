<!DOCTYPE html>
<html lang="en">
    <head>
        <x-head-component/>
    </head>
    <body>
        <x-header-component/>

        <div class="container mt-5">
            @if(session('status'))
                <div class="alert alert-success mb-3" role="alert">
                    {{session('status')}}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                  Email Verification
                </div>
                <div class="card-body">
                  <h5 class="card-title">Attention !</h5>
                  <p class="card-text">You must verify email address, please check your email for a verification link.</p>
                  <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <input name="login" id="login" class="btn btn-primary" type="submit" value="Resend Email">
                </form>
                </div>
            </div>
        </div>
    </body>
</html>





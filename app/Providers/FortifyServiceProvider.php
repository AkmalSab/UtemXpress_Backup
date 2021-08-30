<?php

namespace App\Providers;

use App\Models\User;
use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Support\Facades\DB;
use Laravel\Fortify\Contracts\LoginResponse;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Hash;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->instance(LoginResponse::class, new class implements LoginResponse {
            public function toResponse($request)
            {
                $user = $request->user();
                $role = $user->userRole()->first();

                if ($role->role_id == '1') {
                    return redirect()->intended(config('fortify.student'));
                }
                else if ($role->role_id == '2') {
                    return redirect()->intended(config('fortify.staff'));
                }
                else if ($role->role_id == '3') {
                    return redirect()->intended(config('fortify.runner'));
                }
                else if ($role->role_id == '4') {
                    return redirect()->intended(config('fortify.admin'));
                }
                else if ($role->role_id == '5') {
                    return redirect()->intended(config('fortify.admin'));
                }
            }
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        Fortify::loginView(function(){
            return view('auth.login');
        });

        Fortify::registerView(function(){
            return view('auth.register');
        });

        Fortify::requestPasswordResetLinkView(function(){
            return view('auth.forgot-password');
        });

        Fortify::resetPasswordView(function($request){
            return view('auth.reset-password', ['request' => $request]);
        });

        Fortify::verifyEmailView(function($request){
            return view('auth.verify-email');
        });

        Fortify::confirmPasswordView(function($request){
            return view('auth.password-confirm');
        });

        Fortify::twoFactorChallengeView(function($request){
            return view('auth.two-factor-challenge');
        });

        Fortify::authenticateUsing(function (Request $request) {

            if(isset($request->runnerRoleDetermine)){
                $users = DB::table('users')
                    ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
                    ->select('users.*')
                    ->where('users.email', '=', $request->email)
                    ->where('user_roles.role_id', '=', 3)
                    ->first();

                if($users == null)
                    throw ValidationException::withMessages(['email' => 'User not found']);

                $user = User::where('id', $users->id)->first();
                if ($user && !Hash::check($request->password, $user->password)) {
                    throw ValidationException::withMessages(['email' => 'This credential is incorrect']);
                }
                if ($user->user_status != 'AVAILABLE'){
                    throw ValidationException::withMessages(['email' => 'The user has been disabled. Please contact helpdesk.']);
                }
                return $user;
            }
            else{
                $users = DB::table('users')
                    ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
                    ->select('users.*')
                    ->where('users.email', '=', $request->email)
                    ->where('user_roles.role_id', '!=', 3)
                    ->first();

                if($users == null)
                    throw ValidationException::withMessages(['email' => "User not found, if you are runner please tick 'I am runner' checkbox below"]);

                $user = User::where('id', $users->id)->first();

                if ($user && !Hash::check($request->password, $user->password)) {
                    throw ValidationException::withMessages(['email' => 'This credential is incorrect']);
                }

                if ($user->user_status != 'AVAILABLE'){
                    throw ValidationException::withMessages(['email' => 'The user has been disabled. Please contact helpdesk.']);
                }
                return $user;
            }
        });
    }
}

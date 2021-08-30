<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //Redirect user to home page based on their's role
    function index(){

        $userID = Auth::user()->id;

        $role = DB::table('user_roles')->where('user_id', $userID)->first();

        if ($role->role_id == '1') {
            return redirect('/student/home');
        }
        else if ($role->role_id == '2') {
            return redirect('/staff/home');
        }
        else if ($role->role_id == '3') {
            return redirect('/runner/home');
        }
        else if ($role->role_id == '4') {
            return redirect('/admin/home');
        }
        else if ($role->role_id == '5') {
            return redirect('/admin/home');
        }
    }

    function userInfo(){
        $userID = Auth::user()->id;

        $role = DB::table('user_roles')->where('user_id', $userID)->first();

        if ($role->role_id == '1') {

            $nric = DB::table('users')
                ->where('users.id', '=', Auth::user()->id)
                ->select('users.*')
                ->get();


            //dd($nric);
            return view('student.profile', compact('nric'));
        }
        else if ($role->role_id == '2') {

            $nric = DB::table('users')
                ->where('users.id', '=', Auth::user()->id)
                ->select('users.*')
                ->get();

            return view('staff.profile', compact('nric'));
        }
        else if ($role->role_id == '3') {

            $vehicle = DB::table('runner_vehicle')
                ->join('runner', 'runner_vehicle.runner_id', '=', 'runner.runner_id')
                ->join('users', 'runner.user_id', '=', 'users.id')
                ->where('users.id', '=', Auth::user()->id)
                ->count('runner_vehicle.vehicle_id');

            $license = DB::table('runner')
                ->join('users', 'runner.user_id', '=', 'users.id')
                ->where('users.id', '=', Auth::user()->id)
                ->select('runner.*')
                ->get();

            $vehicledDetails = DB::table('runner_vehicle')
                ->join('runner', 'runner_vehicle.runner_id', '=', 'runner.runner_id')
                ->join('users', 'runner.user_id', '=', 'users.id')
                ->where('users.id', '=', Auth::user()->id)
                ->select('runner_vehicle.*')
                ->get();

//            dump($vehicle);
//            dump($license);
//            dump($vehicledDetails);
            return view('runner.profile', compact('vehicle', 'vehicledDetails', 'license'));
        }
        else if ($role->role_id == '4' || $role->role_id == '5') {
            $users = DB::table('users')
                ->join('admins', 'users.email', '=', 'admins.admin_email')
                ->where('users.email', '=', Auth::user()->email)
                ->select('users.*')
                ->get();

            $admins = DB::table('users')
                ->join('admins', 'users.email', '=', 'admins.admin_email')
                ->where('users.email', '=', Auth::user()->email)
                ->select('admins.*')
                ->get();

            return view('admin.profile', compact('users', 'admins'));
        }
    }

    function testDistance(){
        return view('auth.distance');
    }
}

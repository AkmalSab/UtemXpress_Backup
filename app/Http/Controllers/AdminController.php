<?php

namespace App\Http\Controllers;

use App\Models\Runner;
use App\Models\Staff;
use App\Models\Student;
use App\Models\User;
use App\Models\Order;
use App\Models\Admin;

use App\Models\User_Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function data(){

        $userID = Auth::user()->id;
        $userEmail = Auth::user()->email;

        $adminName = Admin::where('admin_email', $userEmail)->get();
        foreach ($adminName as $item)
            $adminName = $item->admin_name;

        //get number of order
        $totalOrders = Order::all();
        $totalOrders = $totalOrders->count();

        //get number of user
        $totalUsers = User::all();
        $totalUsers = $totalUsers->count();

        //get number of runner
        $totalRunners = Runner::all();
        $totalRunners = $totalRunners->count();

        //get number of admin
        $totalAdmins = Admin::all();
        $totalAdmins = $totalAdmins->count();

        //get number of completed orders
        $totalOrdersCompleted = Order::where('order_status', 'completed')->count();

        //get number of cancelled orders
        $totalOrdersCancelled = Order::where('order_status', 'cancelled')->count();

        //get number of waiting orders
        $totalOrdersWaiting = Order::where('order_status', 'waiting')->count();

        //get number of picked-up orders
        $totalOrdersPicked = Order::where('order_status', 'picked-up')->count();

        //get number of on-going orders
        $totalOrdersOngoing = Order::where('order_status', 'on-going')->count();

        //get number of student from FTMK
        $Student_FTMK = DB::table('users')
            ->join('students', 'users.email', '=', 'students.student_email')
            ->select('users.*')
            ->where('students.student_faculty', '=', 'FAKULTI TEKNOLOGI MAKLUMAT DAN KOMUNIKASI')
            ->count();

        $Staff_FTMK = DB::table('users')
            ->join('staffs', 'users.email', '=', 'staffs.staff_email')
            ->select('users.*')
            ->where('staffs.staff_faculty', '=', 'FAKULTI TEKNOLOGI MAKLUMAT DAN KOMUNIKASI')
            ->count();

        //get number of student from FKEKK
        $Student_FKEKK = DB::table('users')
            ->join('students', 'users.email', '=', 'students.student_email')
            ->select('users.*')
            ->where('students.student_faculty', '=', 'FAKULTI KEJURUTERAAN ELEKTRONIK DAN KOMPUTER')
            ->count();

        $Staff_FKEKK = DB::table('users')
            ->join('staffs', 'users.email', '=', 'staffs.staff_email')
            ->select('users.*')
            ->where('staffs.staff_faculty', '=', 'FAKULTI KEJURUTERAAN ELEKTRONIK DAN KOMPUTER')
            ->count();

        //get number of student from FKE
        $Student_FKE = DB::table('users')
            ->join('students', 'users.email', '=', 'students.student_email')
            ->select('users.*')
            ->where('students.student_faculty', '=', 'FAKULTI KEJURUTERAAN ELEKTRIK')
            ->count();

        $Staff_FKE = DB::table('users')
            ->join('staffs', 'users.email', '=', 'staffs.staff_email')
            ->select('users.*')
            ->where('staffs.staff_faculty', '=', 'FAKULTI KEJURUTERAAN ELEKTRIK')
            ->count();

        //get number of student from FKM
        $Student_FKM = DB::table('users')
            ->join('students', 'users.email', '=', 'students.student_email')
            ->select('users.*')
            ->where('students.student_faculty', '=', 'FAKULTI KEJURUTERAAN MEKANIKAL')
            ->count();

        $Staff_FKM = DB::table('users')
            ->join('staffs', 'users.email', '=', 'staffs.staff_email')
            ->select('users.*')
            ->where('staffs.staff_faculty', '=', 'FAKULTI KEJURUTERAAN MEKANIKAL')
            ->count();

        //get number of student from FPTT
        $Student_FPTT = DB::table('users')
            ->join('students', 'users.email', '=', 'students.student_email')
            ->select('users.*')
            ->where('students.student_faculty', '=', 'FAKULTI PENGURUSAN TEKNOLOGI DAN TEKNOPRENEURSHIP')
            ->count();

        $Staff_FPTT = DB::table('users')
            ->join('staffs', 'users.email', '=', 'staffs.staff_email')
            ->select('users.*')
            ->where('staffs.staff_faculty', '=', 'FAKULTI PENGURUSAN TEKNOLOGI DAN TEKNOPRENEURSHIP')
            ->count();

        //get number of student from FTKMP
        $Student_FTKMP = DB::table('users')
            ->join('students', 'users.email', '=', 'students.student_email')
            ->select('users.*')
            ->where('students.student_faculty', '=', 'FAKULTI TEKNOLOGI KEJURUTERAAN MEKANIKAL DAN PEMBUATAN')
            ->count();

        $Staff_FTKMP = DB::table('users')
            ->join('staffs', 'users.email', '=', 'staffs.staff_email')
            ->select('users.*')
            ->where('staffs.staff_faculty', '=', 'FAKULTI TEKNOLOGI KEJURUTERAAN MEKANIKAL DAN PEMBUATAN')
            ->count();

        $walkOrderSum = DB::table('order')
            ->where('order.vehicle_id', '=', 1)
            ->where('order_status', '=', 'completed')
            ->sum('order.order_fee');

        $motorOrderSum = DB::table('order')
            ->where('order.vehicle_id', '=', 2)
            ->where('order_status', '=', 'completed')
            ->sum('order.order_fee');

        $carOrderSum = DB::table('order')
            ->where('order.vehicle_id', '=', 3)
            ->where('order_status', '=', 'completed')
            ->sum('order.order_fee');

        $totalOrdersCountJan = DB::table('order')
            ->select(DB::raw('MONTH(order_date) as month, COUNT(order_id) as total, vehicle_id as vehicle'))
            ->where('order_status', '=', 'completed')
            ->whereRaw('MONTH(order_date) = 1')
            ->groupByRaw('MONTH(order_date)')
            ->groupByRaw('vehicle_id')
            ->get();
        $totalOrdersCountFeb = DB::table('order')
            ->select(DB::raw('MONTH(order_date) as month, COUNT(order_id) as total, vehicle_id as vehicle'))
            ->where('order_status', '=', 'completed')
            ->whereRaw('MONTH(order_date) = 2')
            ->groupByRaw('MONTH(order_date)')
            ->groupByRaw('vehicle_id')
            ->get();
        $totalOrdersCountMar = DB::table('order')
            ->select(DB::raw('MONTH(order_date) as month, COUNT(order_id) as total, vehicle_id as vehicle'))
            ->where('order_status', '=', 'completed')
            ->whereRaw('MONTH(order_date) = 3')
            ->groupByRaw('MONTH(order_date)')
            ->groupByRaw('vehicle_id')
            ->get();
        $totalOrdersCountApr = DB::table('order')
            ->select(DB::raw('MONTH(order_date) as month, COUNT(order_id) as total, vehicle_id as vehicle'))
            ->where('order_status', '=', 'completed')
            ->whereRaw('MONTH(order_date) = 4')
            ->groupByRaw('MONTH(order_date)')
            ->groupByRaw('vehicle_id')
            ->get();
        $totalOrdersCountMay = DB::table('order')
            ->select(DB::raw('MONTH(order_date) as month, COUNT(order_id) as total, vehicle_id as vehicle'))
            ->where('order_status', '=', 'completed')
            ->whereRaw('MONTH(order_date) = 5')
            ->groupByRaw('MONTH(order_date)')
            ->groupByRaw('vehicle_id')
            ->get();
        $totalOrdersCountJun = DB::table('order')
            ->select(DB::raw('MONTH(order_date) as month, COUNT(order_id) as total, vehicle_id as vehicle'))
            ->where('order_status', '=', 'completed')
            ->whereRaw('MONTH(order_date) = 6')
            ->groupByRaw('MONTH(order_date)')
            ->groupByRaw('vehicle_id')
            ->get();
        $totalOrdersCountJul = DB::table('order')
            ->select(DB::raw('MONTH(order_date) as month, COUNT(order_id) as total, vehicle_id as vehicle'))
            ->where('order_status', '=', 'completed')
            ->whereRaw('MONTH(order_date) = 7')
            ->groupByRaw('MONTH(order_date)')
            ->groupByRaw('vehicle_id')
            ->get();
        $totalOrdersCountAug = DB::table('order')
            ->select(DB::raw('MONTH(order_date) as month, COUNT(order_id) as total, vehicle_id as vehicle'))
            ->where('order_status', '=', 'completed')
            ->whereRaw('MONTH(order_date) = 8')
            ->groupByRaw('MONTH(order_date)')
            ->groupByRaw('vehicle_id')
            ->get();
        $totalOrdersCountSep = DB::table('order')
            ->select(DB::raw('MONTH(order_date) as month, COUNT(order_id) as total, vehicle_id as vehicle'))
            ->where('order_status', '=', 'completed')
            ->whereRaw('MONTH(order_date) = 9')
            ->groupByRaw('MONTH(order_date)')
            ->groupByRaw('vehicle_id')
            ->get();
        $totalOrdersCountOct = DB::table('order')
            ->select(DB::raw('MONTH(order_date) as month, COUNT(order_id) as total, vehicle_id as vehicle'))
            ->where('order_status', '=', 'completed')
            ->whereRaw('MONTH(order_date) = 10')
            ->groupByRaw('MONTH(order_date)')
            ->groupByRaw('vehicle_id')
            ->get();
        $totalOrdersCountNov = DB::table('order')
            ->select(DB::raw('MONTH(order_date) as month, COUNT(order_id) as total, vehicle_id as vehicle'))
            ->where('order_status', '=', 'completed')
            ->whereRaw('MONTH(order_date) = 11')
            ->groupByRaw('MONTH(order_date)')
            ->groupByRaw('vehicle_id')
            ->get();
        $totalOrdersCountDec = DB::table('order')
            ->select(DB::raw('MONTH(order_date) as month, COUNT(order_id) as total, vehicle_id as vehicle'))
            ->where('order_status', '=', 'completed')
            ->whereRaw('MONTH(order_date) = 12')
            ->groupByRaw('MONTH(order_date)')
            ->groupByRaw('vehicle_id')
            ->get();

//        dump($totalOrdersCountJan);
//        dump($totalOrdersCountFeb);
//        dump($totalOrdersCountMar);
//        dump($totalOrdersCountApr);
//        dump($totalOrdersCountMay);
//        dump($totalOrdersCountJun);
//        dump($totalOrdersCountJul);
//        dump($totalOrdersCountAug);
//        dump($totalOrdersCountSep);
//        dump($totalOrdersCountOct);
//        dump($totalOrdersCountNov);
//        dump($totalOrdersCountDec);

        return view('admin.home',
            compact('adminName',
                'totalOrders',
                'totalUsers',
                'totalRunners',
                'totalAdmins',
                'totalOrdersCompleted',
                'totalOrdersCancelled',
                'totalOrdersWaiting',
                'totalOrdersPicked',
                'totalOrdersOngoing',
                'Student_FTMK',
                'Staff_FTMK',
                'Student_FKEKK',
                'Staff_FKEKK',
                'Student_FKE',
                'Staff_FKE',
                'Student_FKM',
                'Staff_FKM',
                'Student_FPTT',
                'Staff_FPTT',
                'Student_FTKMP',
                'Staff_FTKMP',
                'walkOrderSum',
                'motorOrderSum',
                'carOrderSum',
                'totalOrdersCountJan',
                'totalOrdersCountFeb',
                'totalOrdersCountMar',
                'totalOrdersCountApr',
                'totalOrdersCountMay',
                'totalOrdersCountJun',
                'totalOrdersCountJul',
                'totalOrdersCountAug',
                'totalOrdersCountSep',
                'totalOrdersCountOct',
                'totalOrdersCountNov',
                'totalOrdersCountDec'));
    }

    public function addIcAdmin(Request $req){

//        dd($req->all());

        $userID = Auth::user()->id;
//        $destinationPath = 'identification_card';
//
//        $files=$req->file('IcFrontImage');
//        $name = $files->getClientOriginalName();
//        $size = $files->getSize();
//
//        $files2=$req->file('IcBackImage');
//        $name2 = $files2->getClientOriginalName();
//        $size2 = $files2->getSize();
//
//        $path = $files->move($destinationPath,$name);
//        $path2 = $files2->move($destinationPath,$name2);

        User::where('id', $userID)
            ->update([
                'user_nric_picture_front' => $req->input('IcFrontImageUrl'),
                'user_nric_picture_back' => $req->input('IcBackImageUrl'),
            ]);

        return redirect()->back()->with('success', 'Identification card image has been uploaded successfully');
//        return redirect('/admin/profile');
    }

    public function addImageAdmin(Request $req){

//        dd($req->all());

        $userID = Auth::user()->id;

//        $destinationPath = 'user_image';
//
//        $files=$req->file('UserImage');
//        $name = $files->getClientOriginalName();
//        $size = $files->getSize();
//
//        $path = $files->move($destinationPath,$name);

        User::where('id', $userID)
            ->update([
                'user_picture' => $req->input('UserImageUrl'),
            ]);

        return redirect()->back()->with('success', 'Personal image has been uploaded successfully');
//        return redirect('/admin/profile');
    }

    public function manageUser(){

        $i = 1;

        $Users = DB::table('users')
            ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
            ->select('users.*', 'user_roles.*')
            ->whereIn('user_roles.role_id', [1, 2])
            ->get();

        //dump($Users);

        return view ('admin.manageUser', ['Users' => $Users, 'i' => $i]);

    }

    public function manageRunner(){
        $i = 1;

        $Users = DB::table('users')
            ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
            ->select('users.*', 'user_roles.*')
            ->whereIn('user_roles.role_id', [3])
            ->get();

        return view ('admin.manageRunner', ['Users' => $Users, 'i' => $i]);
    }

    public function manageOrder(){
        $i = 1;

        $Order = DB::table('order')
            ->get();

        //dump($Order);

        return view ('admin.manageOrder', ['Orders' => $Order, 'i' => $i]);
    }

    public function manageAdmin(){

        $admin = Admin::all();
        $i = 1;
        $userID = Auth::user()->id;

        $userRoles = DB::table('admins')
            ->join('user_roles', 'user_roles.admin_email', '=', 'admins.admin_email')
            ->select('user_roles.role_id')
            ->where('user_roles.user_id', '=', $userID)
            ->first();

        return view('admin.manageAdmin', compact('admin', 'i', 'userRoles'));
    }

    public function deactivateAdmin($email){

        $deactivateCount = DB::table('admins')
            ->where('admin_email', $email)
            ->count();

//        dump($deactivateCount);

        if($deactivateCount == 1) {
            $deactivateAdmin = DB::table('admins')
                ->where('admin_email', $email)
                ->update(['admin_status' => 'UNAVAILABLE']);

            return redirect()->back()->with('deactivated', 'Admin has successfully de-activated!');
        }
        else
            return redirect()->back()->with('error', 'Admin not found!');
    }

    public function activateAdmin($email){

        $deactivateCount = DB::table('admins')
            ->where('admin_email', $email)
            ->count();

        if($deactivateCount == 1) {
            $deactivateAdmin = DB::table('admins')
                ->where('admin_email', $email)
                ->update(['admin_status' => 'AVAILABLE']);

            return redirect()->back()->with('activated', 'Admin has successfully re-activated!');
        }
        else
            return redirect()->back()->with('error', 'Admin not found!');
    }

    public function deactivateUser($id){

        $User = User::find($id);
        $User->user_status = 'UNAVAILABLE';
        $User->save();

        return redirect()->back()->with('deactivated', 'User has successfully de-activated!');

    }

    public function activateUser($id){

        $User = User::find($id);
        $User->user_status = 'AVAILABLE';
        $User->save();

        return redirect()->back()->with('activated', 'User has successfully re-activated!');
    }

    public function cancelOrder($id){
        $Order = Order::where('order_id', $id)->update(['order_status' => 'cancelled']);;

        return redirect()->back()->with('cancelled', 'Order has successfully cancelled!');
    }

    public function showOrderDetails($id){

        $OrderDetailsCount = DB::table('order')
            ->where('order_id', '=', $id)
            ->count();

        if($OrderDetailsCount <= 0)
            return view('admin.OrderDetail', compact('OrderDetailsCount'));
        else
        {
            $OrderDetails = DB::table('order')
                ->where('order_id', '=', $id)
                ->get();

            $OrderServiceDetails = DB::table('order_service')
                ->join('additional_services', 'order_service.service_id', '=', 'additional_services.service_id')
                ->where('order_id', '=', $id)
                ->select('additional_services.service_id', 'additional_services.service_name')
                ->get();


            foreach($OrderDetails as $items){
                $runnerTelephone = DB::table('users')
                    ->join('runner', 'runner.user_id', '=', 'users.id')
                    ->join('order', 'order.runner_id', '=', 'runner.runner_id')
                    ->where('order.runner_id', '=', $items->runner_id)
                    ->select('users.user_phone', 'users.name')
                    ->distinct()
                    ->get();

                $customerDetails = DB::table('users')
                    ->join('order', 'order.id', '=', 'users.id')
                    ->where('order.id', '=', $items->id)
                    ->select('users.name', 'users.user_phone')
                    ->distinct()
                    ->get();

//            dump($customerDetails);
            }
            return view('admin.OrderDetail', compact('OrderDetails', 'OrderServiceDetails', 'runnerTelephone', 'customerDetails'));
        }
    }

    public function showRoute($id){


        $OrderDetailsCount = DB::table('order')
            ->where('order_id', '=', $id)
            ->select('order_id','pickup_location_latitude','pickup_location_longitude','dropoff_location_latitude','dropoff_location_longitude')
            ->count();


        if($OrderDetailsCount <= 0)
            return redirect()->back()->with('goodinfo', 'New admin added');

        $OrderDetails = DB::table('order')
            ->where('order_id', '=', $id)
            ->select('order_id','pickup_location_latitude','pickup_location_longitude','dropoff_location_latitude','dropoff_location_longitude')
            ->first();

        return view('auth.map', compact('OrderDetails','OrderDetailsCount'));
    }

    public function showUserDetails($id){

        $UserCount = DB::table('users')
            ->where('users.id', '=', $id)
            ->count();

        if($UserCount <= 0)
            return redirect()->back()->with('error', 'User Not found!');

        $UserDetailsCount = DB::table('users')
            ->join('students', 'students.student_email', '=', 'users.email')
            ->where('users.id', '=', $id)
            ->select('users.*', 'students.*')
            ->count();

        $StaffDetailsCount = DB::table('users')
            ->join('staffs', 'staffs.staff_email', '=', 'users.email')
            ->where('users.id', '=', $id)
            ->select('users.*', 'staffs.*')
            ->count();

        if($UserDetailsCount <= 0){
            $StaffDetails = DB::table('users')
                ->join('staffs', 'staffs.staff_email', '=', 'users.email')
                ->where('users.id', '=', $id)
                ->select('users.*', 'staffs.*')
                ->get();

//            dump($StaffDetails);
            return view('admin.userDetail', compact('StaffDetails'));
        }
        if($StaffDetailsCount <= 0){
            $UserDetails = DB::table('users')
                ->join('students', 'students.student_email', '=', 'users.email')
                ->where('users.id', '=', $id)
                ->select('users.*', 'students.*')
                ->get();

//            dump($UserDetails);
            return view('admin.userDetail', compact('UserDetails'));
        }
    }

    public function showRunnerDetails($id){

        $RunnerCount = DB::table('runner')
            ->where('runner.runner_id', '=', $id)
            ->count();

        if($RunnerCount <= 0)
            return redirect()->back()->with('error', 'Runner Not found!');
        else
        {
            $RunnerDetails = DB::table('runner')
                ->join('users', 'users.id', '=', 'runner.user_id')
                ->join('students', 'students.student_email', '=', 'users.email')
                ->where('runner.runner_id', '=', $id)
                ->select('users.*', 'students.*', 'runner.*')
                ->get();

            $RunnerVehicleDetails = DB::table('runner')
                ->join('runner_vehicle', 'runner_vehicle.runner_id', '=', 'runner.runner_id')
                ->where('runner.runner_id', '=', $id)
                ->select('runner_vehicle.*')
                ->get();


            return view('admin.runnerDetail', compact('RunnerDetails','RunnerVehicleDetails'));
        }
    }

    public function showRunnerDetailsButton($id){

        $getRunnerId = DB::table('users')
            ->join('runner', 'runner.user_id', '=', 'users.id')
            ->select('runner.*')
            ->where('users.id', $id)
            ->count();

        if($getRunnerId <= 0)
            return redirect()->back()->with('error', 'Runner Not found!');
        else
        {
            $RunnerDetails = DB::table('users')
                ->join('students', 'students.student_email', '=', 'users.email')
                ->join('runner', 'runner.user_id', '=', 'users.id')
                ->select('users.*', 'runner.*', 'students.*')
                ->where('users.id', $id)
                ->get();

            $RunnerVehicleDetails = DB::table('runner')
                ->join('users', 'users.id', '=', 'runner.user_id')
                ->join('runner_vehicle', 'runner_vehicle.runner_id', '=', 'runner.runner_id')
                ->where('users.id', '=', $id)
                ->select('runner_vehicle.*')
                ->get();


            return view('admin.runnerDetail', compact('RunnerDetails','RunnerVehicleDetails'));
        }
    }

    public function showAdminDetails($email){
        $UserCount = DB::table('users')
            ->where('email', '=', $email)
            ->count();

//        dump($UserCount);

        if($UserCount <= 0)
            return redirect()->back()->with('error', 'Admin Not found!');


        $UserDetails = DB::table('users')
            ->join('admins', 'admins.admin_email', '=', 'users.email')
            ->where('admins.admin_email', '=', $email)
            ->select('users.*', 'admins.*')
            ->get();

//        dump($UserDetails);

        return view('admin.adminDetail', compact('UserDetails'));

    }

    public function addNewAdmin(Request $req){
//        dump($req->all());

        $status = 'UNREGISTERED';
        $admin = Admin::where('admin_email', $req->input('admin_email'))->count();
        $adminIc = Admin::where('admin_nric', $req->input('admin_nric'))->count();

//        dump($admin);
        if($admin != 1 && $adminIc != 1){

            Admin::create([
                'admin_email' => $req->input('admin_email'),
                'admin_nric' => $req->input('admin_nric'),
                'admin_name' => $req->input('admin_name'),
                'admin_status' => $status,
            ]);

            return redirect()->back()->with('goodinfo', 'New admin added');
        }
        else{
            return redirect()->back()->with('badinfo', 'Admin already exist!');
        }
    }

    public function addNewStudent(Request $req){

        $status = 'UNREGISTERED';
        $user = Student::where('student_email', $req->input('student_email'))->count();
        $studentIc = Student::where('student_nric', $req->input('student_nric'))->count();

//        dump($user);
//        dump($studentIc);
        if($user < 1 && $studentIc < 1){
//            dump('saya lalu sini');
            Student::create([
                'student_email' => $req->input('student_email'),
                'student_nric' => $req->input('student_nric'),
                'student_name' => $req->input('student_name'),
                'student_faculty' => $req->input('student_faculty'),
                'student_status' => $status,
            ]);
            return redirect()->back()->with('goodinfo', 'New student added');
        }
        else
        {
//            dump('saya lalu else');
            return redirect()->back()->with('badinfo', 'Student already exist!');
        }
    }

    public function addNewStaff(Request $req){
//        dd($req->all());

        $status = 'UNREGISTERED';
        $user = Staff::where('staff_email', $req->input('staff_email'))->count();
        $staffIc = Staff::where('staff_nric', $req->input('staff_nric'))->count();

        if($user < 1 && $staffIc < 1){
            Staff::create([
                'staff_email' => $req->input('staff_email'),
                'staff_nric' => $req->input('staff_nric'),
                'staff_name' => $req->input('staff_name'),
                'staff_designation' => $req->input('staff_designation'),
                'staff_faculty' => $req->input('staff_faculty'),
                'staff_division' => $req->input('staff_division'),
                'student_status' => $status,
            ]);
            return redirect()->back()->with('goodinfo', 'New staff added');
        }
        else
        {
            return redirect()->back()->with('badinfo', 'Staff already exist!');
        }
    }
}

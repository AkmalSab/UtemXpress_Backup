<?php

namespace App\Actions\Fortify;

use App\Models\Staff;
use App\Models\User;
use App\Models\Student;
use App\Models\User_Roles;
use App\Models\Runner;
use App\Models\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use PHPUnit\Exception;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */

    public function sendsms($phone, $message){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://terminal.adasms.com/api/v1/send?_token=kXeAAXafkxqE4k7tj6BT4T1XH4kx9u3K&phone=6".$phone."&message=".$message,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET"
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }

    public function create(array $input)
    {

        Validator::make($input, [
            'role_id' => ['required'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
            ],
            'UserPhone' => [
                'required',
                'max:12',
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        if($input['role_id'] == '1'){
            try{
                $countStudent = Student::where('student_email', $input['email'])->count();

                if($countStudent != 1)
                    throw ValidationException::withMessages(['email' => 'Student not found !']);

                $checkStudentRole = DB::table('users')
                    ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
                    ->select('users.*', 'user_roles.*')
                    ->where('users.email','=',$input['email'])
                    ->where('user_roles.role_id','=',$input['role_id'])
                    ->count();

                if($checkStudentRole == 0){

                    $getStudent = Student::where('student_email', $input['email'])->first();
                    $StudentStatus = 'AVAILABLE';

                    $User = User::create([
                        'name' => $getStudent->student_name,
                        'password' => Hash::make($input['password']),
                        'user_phone' => $input['UserPhone'],
                        'email' => $input['email'],
                    ]);
                    $userId = $User->id;
                    User_Roles::create([
                        'role_id' => $input['role_id'],
                        'user_id' => $userId,
                        'student_email' => $input['email'],
                    ]);

                    $updateStudentStatus = DB::table('students')
                        ->where('student_email', $input['email'])
                        ->update(['student_status' => $StudentStatus]);

                    $message = "Thank You ".$User->name.", for registering with UTeM Xpress! Please verify your email to complete the registration process";
                    $u = new CreateNewUser();
                    $u->sendsms($User->user_phone,$message);

                    return $User;
                }
                else
                    throw ValidationException::withMessages(['email' => 'Student with the same role already exist !']);
            }
            catch (\Illuminate\Database\QueryException $e){
                throw ValidationException::withMessages(['phone' => 'Phone number already been used !']);
            }
        }
        else if($input['role_id'] == '2'){
            try{
                $checkStaffExistence = Staff::where('staff_email', $input['email'])->count();
                if($checkStaffExistence != 1)
                    throw ValidationException::withMessages(['email' => 'Staff not found !']);

                $checkStaffAccount = User::where('email', $input['email'])->count();
                if($checkStaffAccount == 0){
                    $getStaff = Staff::where('staff_email', $input['email'])->first();
                    $StaffStatus = 'AVAILABLE';

                    $User = User::create([
                        'name' => $getStaff->staff_name,
                        'password' => Hash::make($input['password']),
                        'user_phone' => $input['UserPhone'],
                        'email' => $input['email'],
                    ]);

                    $userId = $User->id;

                    User_Roles::create([
                        'role_id' => $input['role_id'],
                        'user_id' => $userId,
                        'staff_email' => $input['email'],
                    ]);

                    $updateStaffStatus = DB::table('staffs')
                        ->where('staff_email', $input['email'])
                        ->update(['staff_status' => $StaffStatus]);

                    $message = "Thank You ".$User->name.", for registering with UTeM Xpress! Please verify your email to complete the registration process";
                    $u = new CreateNewUser();
                    $u->sendsms($User->user_phone,$message);

                    return $User;
                }
                else
                    throw ValidationException::withMessages(['email' => 'Staff already exist !']);
            }catch (\Illuminate\Database\QueryException $e){
                throw ValidationException::withMessages(['phone' => 'Phone number already been used !']);
            }
        }
        else if($input['role_id'] == '3'){
            try{
                $countStudent = Student::where('student_email', $input['email'])->count();

                if($countStudent != 1)
                    throw ValidationException::withMessages(['email' => 'Student not found !']);

                $checkStudentRole = DB::table('users')
                    ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
                    ->select('users.*', 'user_roles.*')
                    ->where('users.email','=',$input['email'])
                    ->where('user_roles.role_id','=',$input['role_id'])
                    ->count();

                if($checkStudentRole == 0){

                    $getRunner = Student::where('student_email', $input['email'])->first();

                    $StudentStatus = 'AVAILABLE';

                    $User = User::create([
                        'name' => $getRunner->student_name,
                        'password' => Hash::make($input['password']),
                        'user_phone' => $input['UserPhone'],
                        'email' => $input['email'],
                    ]);

                    $userId = $User->id;

                    User_Roles::create([
                        'role_id' => $input['role_id'],
                        'user_id' => $userId,
                        'student_email' => $input['email'],
                    ]);

                    Runner::create([
                        'user_id' => $userId,
                    ]);

                    $updateStudentStatus = DB::table('students')
                        ->where('student_email', $input['email'])
                        ->update(['student_status' => $StudentStatus]);

                    $message = "Thank You ".$User->name.", for registering with UTeM Xpress! Please verify your email to complete the registration process";
                    $u = new CreateNewUser();
                    $u->sendsms($User->user_phone,$message);

                    return $User;
                }
                else
                    throw ValidationException::withMessages(['email' => 'Student with the same role already exist !']);
            }catch (\Illuminate\Database\QueryException $e){
                throw ValidationException::withMessages(['phone' => 'Phone number already been used !']);
            }
        }
        else if($input['role_id'] == '5'){
            try{
                $checkAdminExistence = Admin::where('admin_email', $input['email'])->count();
                if($checkAdminExistence != 1)
                    throw ValidationException::withMessages(['email' => 'Admin not found !']);

                $checkAdminAccount = User::where('email', $input['email'])->count();
                if($checkAdminAccount == 0){
                    $getAdmin = Admin::where('admin_email', $input['email'])->first();
                    $AdminStatus = 'AVAILABLE';

                    $User = User::create([
                        'name' => $getAdmin->admin_name,
                        'password' => Hash::make($input['password']),
                            'user_phone' => $input['UserPhone'],
                            'email' => $input['email'],
                    ]);

                    $userId = $User->id;

                    User_Roles::create([
                        'role_id' => $input['role_id'],
                        'user_id' => $userId,
                        'admin_email' => $input['email'],
                    ]);

                    $updateAdminStatus = DB::table('admins')
                        ->where('admin_email', $input['email'])
                        ->update(['admin_status' => $AdminStatus]);

                    $message = "Thank You ".$User->name.", for registering with UTeM Xpress! Please verify your email to complete the registration process";
                    $u = new CreateNewUser();
                    $u->sendsms($User->user_phone,$message);

                    return $User;
                }
                else
                    throw ValidationException::withMessages(['email' => 'Admin already exist !']);
            }catch (\Illuminate\Database\QueryException $e){
                throw ValidationException::withMessages(['phone' => 'Phone number already been used !']);
            }
        }
    }
}

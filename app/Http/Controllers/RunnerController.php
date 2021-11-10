<?php

namespace App\Http\Controllers;

use App\Mail\OrderDelivered;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Runner_Vehicle;
use App\Models\Runner;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\stringContains;


class RunnerController extends Controller
{

    public function testFindOrder($id){
        $orders = DB::table('order')
            ->where('order_id', '=', $id)
            ->first();


        $users = DB::table('users')
            ->where('id', '=', $orders->id)
            ->first();

        return new OrderDelivered($orders, $users);
    }

    public function jobListing(){

        $userID = Auth::user()->id;

        $runner_details = DB::table('runner')
            ->where('user_id', $userID)
            ->first();

        $runner_vehicle_details = DB::table('runner_vehicle')
            ->where('runner_id', $runner_details->runner_id)
            ->count();

        $runner_vehicle_type = DB::table('runner_vehicle')
            ->where('runner_id', $runner_details->runner_id)
            ->select('vehicle_type')
            ->get();

        $availableOrderList = null;

        foreach ($runner_vehicle_type as $item){
            if($item->vehicle_type == 'Car'){
                $availableOrderList = DB::table('order')
                    ->where('order_status', '=', 'waiting')
                    ->where('vehicle_id', '=', '3')
                    ->get();
            }
            elseif($item->vehicle_type == 'Motorcycle'){
                $availableOrderList = DB::table('order')
                    ->where('order_status', '=', 'waiting')
                    ->where('vehicle_id', '=', '2')
                    ->get();
            }
            else{
                $availableOrderList = DB::table('order')
                    ->where('order_status', '=', 'waiting')
                    ->where('vehicle_id', '=', '1')
                    ->get();
            }

        }

        return view('runner.home',
            compact('availableOrderList',
                'runner_details',
                'runner_vehicle_type',
                'runner_vehicle_details'));
    }

    public function addRunnerVehicle(Request $req){
//        dd($req->all());

        if($req->input('vehicleType') == "Walk / Bicycle"){
            $userID = Auth::user()->id;
            $runnerID = DB::table('runner')->where('user_id', $userID)->first();
            $status = 'None';
            Runner_Vehicle::create([
                'runner_id' => $runnerID->runner_id,
                'vehicle_type' => $req['vehicleType'],
                'vehicle_picture' => $status,
                'vehicle_number_plate_picture' => $status,
                'vehicle_roadtax_picture' => $status,
            ]);
        }
        else{
            $userID = Auth::user()->id;
            $runnerID = DB::table('runner')->where('user_id', $userID)->first();

//            $destinationPath = 'vehicle';
//            $destinationPath2 = 'roadtax';
//
//            $files=$req->file('vehicleImage');
//            $name = $files->getClientOriginalName();
//            $size = $files->getSize();
//            //dump('$size = '.$size);
//
//            $files2=$req->file('vehicleRoadtaxImage');
//            $name2 = $files2->getClientOriginalName();
//            $size2 = $files2->getSize();
//            //dump('$size2 = '.$size2);

//            $path = $files->move($destinationPath,$name);
//            $path2 =  $files2->move($destinationPath2,$name2);

            Runner_Vehicle::create([
                'runner_id' => $runnerID->runner_id,
                'vehicle_type' => $req->input('vehicleType'),
                'vehicle_picture' => $req->input('vehicleImageUrl'),
                'vehicle_number_plate_picture' => $req->input('vehiclePlateNumber'),
                'vehicle_roadtax_picture' => $req->input('vehicleRoadtaxImageUrl'),
            ]);
        }

        return redirect()->back()->with('success', 'Vehicle information has been uploaded successfully');
//        return redirect('/runner/profile');
    }

    public function updateRunnerVehicle(Request $req){

//        dd($req->all());

        if($req->input('vehicleType') == "Walk / Bicycle"){
            $userID = Auth::user()->id;
            $runnerID = DB::table('runner')->where('user_id', $userID)->first();
            $Status = 'None';
            Runner_Vehicle::where('runner_id', $runnerID->runner_id)
                ->update([
                    'vehicle_type' => $req->input('vehicleType'),
                    'vehicle_picture' => $Status,
                    'vehicle_number_plate_picture' => $Status,
                    'vehicle_roadtax_picture' => $Status,
                ]);

            Runner::where('runner_id', $runnerID->runner_id)
                ->update([
                    'runner_license_picture_front' => $Status,
                    'runner_license_picture_back' => $Status,
                ]);
        }
        else{
            $userID = Auth::user()->id;
            $runnerID = DB::table('runner')->where('user_id', $userID)->first();

//            $destinationPath = 'vehicle';
//            $destinationPath2 = 'roadtax';
//
//            $files = $req->file('vehicleImage');
//            $name = $files->getClientOriginalName();
//            $size = $files->getSize();
//
//            $files2 = $req->file('vehicleRoadtaxImage');
//            $name2 = $files2->getClientOriginalName();
//            $size2 = $files2->getSize();
//
//            $path = $files->move($destinationPath,$name);
//            $path2 =  $files2->move($destinationPath2,$name2);

            Runner_Vehicle::where('runner_id', $runnerID->runner_id)
                ->update([
                    'vehicle_type' => $req->input('vehicleType'),
                    'vehicle_picture' => $req->input('vehicleImageUpdateUrl'),
                    'vehicle_number_plate_picture' => $req->input('vehiclePlateNumberUpdate'),
                    'vehicle_roadtax_picture' => $req->input('vehicleRoadtaxImageUpdateUrl'),
                ]);
        }
        return redirect()->back()->with('success', 'Vehicle information has been updated successfully');
//        return redirect('/runner/profile');
    }

    public function addRunnerLicense(Request $req){
//        dd($req->all());

        $userID = Auth::user()->id;
        $runnerID = DB::table('runner')->where('user_id', $userID)->first();

//        $destinationPath = 'license';
//
//        $files=$req->file('LicenseFrontImage');
//        $name = $files->getClientOriginalName();
//
//        $files2=$req->file('LicenseBackImage');
//        $name2 = $files2->getClientOriginalName();
//
//        $path = $files->move($destinationPath,$name);
//        $path2 = $files2->move($destinationPath,$name2);

        Runner::where('runner_id', $runnerID->runner_id)
            ->update([
                'runner_license_picture_front' => $req->input('LicenseFrontImageUrl'),
                'runner_license_picture_back' => $req->input('LicenseBackImageUrl'),
            ]);

        return redirect()->back()->with('success', 'License image has been uploaded successfully');
//        return redirect('/runner/profile');
    }

    public function updateRunnerLicense(Request $req){
//        dd($req->all());

        $userID = Auth::user()->id;
        $runnerID = DB::table('runner')->where('user_id', $userID)->first();

        Runner::where('runner_id', $runnerID->runner_id)
            ->update([
                'runner_license_picture_front' => $req->input('LicenseFrontImageUpdateUrl'),
                'runner_license_picture_back' => $req->input('LicenseBackImageUpdateUrl'),
            ]);

        return redirect()->back()->with('success', 'License image has been updated successfully');
//        return redirect('/runner/profile');
    }

    public function addRunnerImage(Request $req){

        $userID = Auth::user()->id;

//        $destinationPath = 'user_image';
//        $files=$req->file('personalImage');
//        $name = $files->getClientOriginalName();
//
//        $path = $files->move($destinationPath,$name);

        User::where('id', $userID)
            ->update([
                'user_picture' => $req->input('personalImageUrl'),
            ]);

        return redirect()->back()->with('success', 'Image has been uploaded successfully');

    }

    public function newOrderDetails($id){

        $OrderDetails = DB::table('order')
            ->where('order_id', '=', $id)
            ->get();

        foreach($OrderDetails as $item)
            $orderfee = $item->order_fee;

        //percentage taken by the system 15%
        $percentageTaken = number_format($orderfee * 15/100, 2);

        $OrderServiceDetails = DB::table('order_service')
            ->join('additional_services', 'order_service.service_id', '=', 'additional_services.service_id')
            ->where('order_id', '=', $id)
            ->select('additional_services.service_id', 'additional_services.service_name')
            ->get();

        return view('runner.newOrderDetail', compact('OrderDetails', 'OrderServiceDetails', 'percentageTaken'));
    }

    public function takeNewOrder($id){

        $userID = Auth::user()->id;
        $runnerID = DB::table('runner')->where('user_id', $userID)->first();
        $currentOrderStatus = DB::table('order')->where('order_id', $id)->first();

        if($currentOrderStatus->order_status == 'waiting'){
            $status = 'on-going';
            Order::where('order_id', $id)
                ->update([
                    'runner_id' => $runnerID->runner_id,
                    'order_status' => $status,
                ]);

            return redirect('/runner/showOnGoingOrderDetail/'.$id);
        }

        if($currentOrderStatus->order_status == 'cancelled'){
            return redirect()->back()->with('error', 'Order has been cancelled by the user.');
        }
        else{
            return redirect()->back()->with('error', 'Order has been taken by other runners.');
        }
    }

    public function showOnGoingOrder(){
        $userID = Auth::user()->id;

        $runnerID = DB::table('runner')->where('user_id', $userID)->first();

        $countOnGoingOrders = DB::table('order')
            ->where('runner_id', '=', $runnerID->runner_id)
            ->where('order_status', '=', 'on-going')
            ->count();

        $onGoingOrders = DB::table('order')
            ->where('runner_id', '=', $runnerID->runner_id)
            ->where('order_status', '=', 'on-going')
            ->get();

        return view('runner.onGoingOrder', compact('onGoingOrders', 'countOnGoingOrders'));
    }

    public function showOnGoingOrderDetails($id){

        $onGoingOrderDetails = DB::table('order')
            ->where('order_id', '=', $id)
            ->get();

        $OrderServiceDetails = DB::table('order_service')
            ->join('additional_services', 'order_service.service_id', '=', 'additional_services.service_id')
            ->where('order_id', '=', $id)
            ->select('additional_services.service_id', 'additional_services.service_name')
            ->get();

        $customerDetails = DB::table('users')
            ->join('order', 'order.id', '=', 'users.id')
            ->where('order.order_id', '=', $id)
            ->select('users.name', 'users.user_phone')
            ->get();

//        dump($customerDetails);

        return view('runner.onGoingOrderDetail', compact('onGoingOrderDetails', 'OrderServiceDetails', 'customerDetails'));
    }

    public function updateOrderPickUp($id){
        $status = 'picked-up';
        Order::where('order_id', $id)
            ->update([
                'order_status' => $status,
            ]);

        $orders = DB::table('order')
            ->where('order_id', '=', $id)
            ->first();

        $msg = "Dear ".$orders->receiver_name.", Our runner is currently delivering order and will call you soon.";
        $rc = new RunnerController;
        $rc->sendsms($orders->receiver_phone,$msg);

        return redirect()->back()->with('success', 'Order status has updated to "picked-up"');
    }

    function sendsms($phone, $message){
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

    public function updateOrderComplete($id){
        $userID = Auth::user()->id;
        $runnerID = DB::table('runner')->where('user_id', $userID)->first();
        $status = 'completed';
        Order::where('order_id', $id)
            ->update([
                'order_status' => $status,
            ]);

        //send email to user after order has been delivered
        $orders = DB::table('order')
            ->where('order_id', '=', $id)
            ->first();

        $users = DB::table('users')
            ->where('id', '=', $orders->id)
            ->first();

        // Mail::to($users->email)->send(new OrderDelivered($orders,$users));

        // $msg = "Dear ".$users->name.", Our runner has delivered your order [".$orders->order_id."]. Don't forget to leave a review to our runner.";

        // $rc = new RunnerController;
        // $rc->sendsms($users->user_phone,$msg);

        return redirect()->back()->with('success', 'Order status has updated to "completed"');
    }

    public function completedOrder(){
        $userID = Auth::user()->id;
        $runnerID = DB::table('runner')->where('user_id', $userID)->first();

        $completeOrders = DB::table('order')
            ->where('runner_id', '=', $runnerID->runner_id)
            ->where('order_status', '=', 'completed')
            ->get();

        return view('runner.pastOrder', compact('completeOrders'));
    }

    public function showCompletedOrderDetails($id){

        $completedOrders = DB::table('order')
            ->where('order_id', '=',$id)
            ->get();

        $OrderServiceDetails = DB::table('order_service')
            ->join('additional_services', 'order_service.service_id', '=', 'additional_services.service_id')
            ->where('order_id', '=', $id)
            ->select('additional_services.service_id', 'additional_services.service_name')
            ->get();

        $customerDetails = DB::table('users')
            ->join('order', 'order.id', '=', 'users.id')
            ->where('order.order_id', '=', $id)
            ->select('users.name', 'users.user_phone')
            ->get();

//        dump($customerDetails);

        return view('runner.pastOrderDetail', compact('completedOrders', 'OrderServiceDetails', 'customerDetails'));
    }

    public function updateOrderRating(Request $req, $id){

        if(!$req->has('rate'))
            return redirect()->back()->with('error', 'Please do not leave the rate empty');
        else{
            Order::where('order_id', $id)
                ->update([
                    'runner_rating' => $req->input('rate'),
                ]);

            return redirect()->back()->with('success', 'Order has successfully rated');
        }
    }

    public function showEarnings(){

        //get user id
        $userID = Auth::user()->id;

        //get runner id
        $runnerID = DB::table('runner')->where('user_id', $userID)->first();

        //get completed order
        $totalOrders = DB::table('order')
            ->where('order_status', '=', 'completed')
            ->where('runner_id', '=', $runnerID->runner_id)
            ->count();

        //get total orders fee collected
        $sumOrdersFee = DB::table('order')
            ->where('runner_id', '=', $runnerID->runner_id)
            ->where('order_status', '=', 'completed')
            ->sum('order_fee');

        //get runner rating
        $runnerRating = DB::table('order')
            ->where('runner_id', '=', $runnerID->runner_id)
            ->where('order_status', '=', 'completed')
            ->avg('user_rating');

        //get number of user favorite runner
        $favoured = DB::table('order')
            ->where('favourite', '=', '1')
            ->where('runner_id', '=', $runnerID->runner_id)
            ->where('order_status', '=', 'completed')
            ->distinct()
            ->count('id');

        //get statistical data
        $statisticOrders = DB::table('order')
            ->select(DB::raw("COUNT(`order_id`) AS TotalOrder, SUM(`order_fee`) AS TotalFee, DATE_FORMAT(`order_date`, '%M') AS 'Month'"))
            ->where('runner_id', '=', $runnerID->runner_id)
            ->where('order_status', '=', 'completed')
            ->groupByRaw("Month")
            ->orderByRaw("Month DESC")
            ->get();

//        dd($statisticOrders);

        return view('runner.earning', compact(
            'sumOrdersFee',
            'statisticOrders',
            'totalOrders',
            'runnerRating',
            'favoured'));
    }

    public function showAllOrderRecords(){

        $userId = Auth::id();

        $Order = DB::table('order')
            ->join('runner', 'runner.runner_id', '=', 'order.runner_id')
            ->whereIn('order_status', ['completed', 'cancelled'])
            ->where('runner.user_id', '=', $userId)
            ->get();

        return response()->json($Order, 200);
    }

    public function showCompletedOrderRecords(){
        $userId = Auth::id();

        $Order = DB::table('order')
            ->join('runner', 'runner.runner_id', '=', 'order.runner_id')
            ->where('order_status', '=', 'completed')
            ->where('runner.user_id', '=', $userId)
            ->get();

        return response()->json($Order, 200);
    }

    public function showCancelledOrderRecords(){
        $userId = Auth::id();
        $Order = DB::table('order')
            ->join('runner', 'runner.runner_id', '=', 'order.runner_id')
            ->where('order_status', '=', 'cancelled')
            ->where('runner.user_id', '=', $userId)
            ->get();

        return response()->json($Order, 200);
    }

    public function showRoute($id){
        $OrderDetails = DB::table('order')
            ->where('order_id', '=', $id)
            ->select('order_id','pickup_location_latitude','pickup_location_longitude','dropoff_location_latitude','dropoff_location_longitude')
            ->first();

        return view('auth.map', compact('OrderDetails'));
    }

}

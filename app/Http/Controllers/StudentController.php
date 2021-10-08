<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderService;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;


class StudentController extends Controller
{
    public function createOrderWalks(Request $req){
        $arr = array_merge($req->all());
//        dump($req->all());
        return redirect('/student/setOrderDateTime/'.serialize($arr));
    }

    public function createOrderMotors(Request $req){
        $arr = array_merge($req->all());
        return redirect('/student/setOrderDateTimeMotor/'.serialize($arr));
    }

    public function createOrderCars(Request $req){
        $arr = array_merge($req->all());
        return redirect('/student/setOrderDateTimeCar/'.serialize($arr));
    }

    public function processOrderWalks($arr){

        //Get user's name
        $users = DB::table('users')
            ->join('students', 'users.email', '=', 'students.student_email')
            ->where('users.email', '=', Auth::user()->email)
            ->select('students.student_name')
            ->get();

        $vehicle = 1;
        $pickUpLocation = null;
        $latitudePickup = null;
        $longitudePickup = null;
        $dropOffLocation = null;
        $latitudeDropOff = null;
        $longitudeDropOff = null;
        $XpressBag = null;
        $BuyForYou = null;
        $ReturnTrip = null;
        $dn = null;
        $ofl = null;
        $orderPrice = null;

        foreach(unserialize($arr) as $key => $data){
            if($key == "pickUpLocation")
                $pickUpLocation = $data;
            if($key == "latitudePickup")
                $latitudePickup = $data;
            if($key == "longitudePickup")
                $longitudePickup = $data;
            if($key == "dropOffLocation")
                $dropOffLocation = $data;
            if($key == "latitudeDropOff")
                $latitudeDropOff = $data;
            if($key == "longitudeDropOff")
                $longitudeDropOff = $data;
            if($key == "XpressBag")
                $XpressBag = $data;
            if($key == "BuyForYou")
                $BuyForYou = $data;
            if($key == "dn")
                $dn = $data;
            if($key == "ofl")
                $ofl = $data;
            if($key == "orderFinalPrice2")
                $orderPrice = $data;

//            dump("key = ".$key." data = ".$data);
        }

        if($dn != null){
            //dump('order ni order now');
            return view('student.delivery',
                compact(
                    'pickUpLocation',
                    'latitudePickup',
                    'longitudePickup',
                    'dropOffLocation',
                    'latitudeDropOff',
                    'longitudeDropOff',
                    'XpressBag',
                    'BuyForYou',
                    'ReturnTrip',
                    'dn',
                    'users',
                    'orderPrice',
                    'vehicle'));
        }
        if($ofl != null){
            //dump('order ni order for later');

            return view('student.deliveryLater',
                compact(
                    'pickUpLocation',
                    'latitudePickup',
                    'longitudePickup',
                    'dropOffLocation',
                    'latitudeDropOff',
                    'longitudeDropOff',
                    'XpressBag',
                    'BuyForYou',
                    'ReturnTrip',
                    'ofl',
                    'users',
                    'orderPrice',
                    'vehicle'));
        }
    }

    public function processOrderMotors($arr){
        //Get user's name
        $users = DB::table('users')
            ->join('students', 'users.email', '=', 'students.student_email')
            ->where('users.email', '=', Auth::user()->email)
            ->select('students.student_name')
            ->get();

        $vehicle = 2;

        $pickUpLocation = null;
        $latitudePickup = null;
        $longitudePickup = null;

        $dropOffLocation = null;
        $latitudeDropOff = null;
        $longitudeDropOff = null;

        $XpressBag = null;
        $BuyForYou = null;
        $ReturnTrip = null;
        $dn = null;
        $ofl = null;
        $orderPrice = null;

        foreach(unserialize($arr) as $key => $data){
            if($key == "pickUpLocation")
                $pickUpLocation = $data;
            if($key == "latitudePickup")
                $latitudePickup = $data;
            if($key == "longitudePickup")
                $longitudePickup = $data;
            if($key == "dropOffLocation")
                $dropOffLocation = $data;
            if($key == "latitudeDropOff")
                $latitudeDropOff = $data;
            if($key == "longitudeDropOff")
                $longitudeDropOff = $data;
            if($key == "XpressBag")
                $XpressBag = $data;
            if($key == "BuyForYou")
                $BuyForYou = $data;
            if($key == "ReturnTrip")
                $ReturnTrip = $data;
            if($key == "dn")
                $dn = $data;
            if($key == "ofl")
                $ofl = $data;
            if($key == "orderFinalPrice2")
                $orderPrice = $data;

            //dump("key = ".$key." data = ".$data);
        }

        if($dn != null){
            //dump('order ni order now');
            return view('student.delivery',
                compact(
                    'pickUpLocation',
                    'latitudePickup',
                    'longitudePickup',
                    'dropOffLocation',
                    'latitudeDropOff',
                    'longitudeDropOff',
                    'XpressBag',
                    'BuyForYou',
                    'ReturnTrip',
                    'dn',
                    'users',
                    'orderPrice',
                    'vehicle'));
        }
        if($ofl != null){
            //dump('order ni order for later');
            return view('student.deliveryLater',
                compact(
                    'pickUpLocation',
                    'latitudePickup',
                    'longitudePickup',
                    'dropOffLocation',
                    'latitudeDropOff',
                    'longitudeDropOff',
                    'XpressBag',
                    'BuyForYou',
                    'ReturnTrip',
                    'ofl',
                    'users',
                    'orderPrice',
                    'vehicle'));
        }
    }

    public function processOrderCars($arr){
        //Get user's name
        $users = DB::table('users')
            ->join('students', 'users.email', '=', 'students.student_email')
            ->where('users.email', '=', Auth::user()->email)
            ->select('students.student_name')
            ->get();

        $vehicle = 3;
        $pickUpLocation = null;
        $latitudePickup = null;
        $longitudePickup = null;
        $dropOffLocation = null;
        $latitudeDropOff = null;
        $longitudeDropOff = null;
        $XpressBag = null;
        $BuyForYou = null;
        $ReturnTrip = null;
        $DoorToDoor = null;
        $dn = null;
        $ofl = null;
        $orderPrice = null;

        foreach(unserialize($arr) as $key => $data){
            if($key == "pickUpLocation")
                $pickUpLocation = $data;
            if($key == "latitudePickup")
                $latitudePickup = $data;
            if($key == "longitudePickup")
                $longitudePickup = $data;
            if($key == "dropOffLocation")
                $dropOffLocation = $data;
            if($key == "latitudeDropOff")
                $latitudeDropOff = $data;
            if($key == "longitudeDropOff")
                $longitudeDropOff = $data;
            if($key == "XpressBag")
                $XpressBag = $data;
            if($key == "BuyForYou")
                $BuyForYou = $data;
            if($key == "ReturnTrip")
                $ReturnTrip = $data;
            if($key == "DoorToDoor")
                $DoorToDoor = $data;
            if($key == "dn")
                $dn = $data;
            if($key == "ofl")
                $ofl = $data;
            if($key == "orderFinalPrice2")
                $orderPrice = $data;

            //dump("key = ".$key." data = ".$data);
        }

        if($dn != null){
            //dump('order ni order now');
            return view('student.delivery',
                compact(
                    'pickUpLocation',
                    'latitudePickup',
                    'longitudePickup',
                    'dropOffLocation',
                    'latitudeDropOff',
                    'longitudeDropOff',
                    'XpressBag',
                    'BuyForYou',
                    'ReturnTrip',
                    'DoorToDoor',
                    'dn',
                    'users',
                    'orderPrice',
                    'vehicle'));
        }
        if($ofl != null){
            //dump('order ni order for later');
            return view('student.deliveryLater',
                compact(
                    'pickUpLocation',
                    'latitudePickup',
                    'longitudePickup',
                    'dropOffLocation',
                    'latitudeDropOff',
                    'longitudeDropOff',
                    'XpressBag',
                    'BuyForYou',
                    'ReturnTrip',
                    'DoorToDoor',
                    'ofl',
                    'users',
                    'orderPrice',
                    'vehicle'));
        }
    }

    public function SubmitOrderLaters(Request $req){

        $vehicle_id = null;
        $xpress = 1;
        $buy4u = 2;
        $returntrip = 3;
        $status = "waiting";
        $type = "for-later";
        $senderName = null;
        $userPhone = null;
        $receiverName = null;
        $receiverPhone = null;
        $runnerNote = null;
        $pickUpLocation = null;
        $latitudePickup = null;
        $longitudePickup = null;
        $dropOffLocation = null;
        $latitudeDropOff = null;
        $longitudeDropOff = null;
        $XpressBag = null;
        $BuyForYou = null;
        $ReturnTrip = null;
        $orderPrice = null;
        $orderDateLater = null;
        $orderTimeLater = null;

        foreach($req->all() as $key => $data) {
//            dump('$Key => ' . $key . ' $data => ' . $data);

            if($key == "vehicle")
                $vehicle_id = $data;
            if($key == "orderDateLater")
                $orderDateLater = $data;
            if($key == "orderTimeLater")
                $orderTimeLater = $data;
            if($key == "senderName")
                $senderName = $data;
            if($key == "userPhone")
                $userPhone = $data;
            if($key == "receiverName")
                $receiverName = $data;
            if($key == "receiverPhone")
                $receiverPhone = $data;
            if($key == "runnerNote")
                $runnerNote = $data;
            if($key == "pickUpLocation")
                $pickUpLocation = $data;
            if($key == "latitudePickup")
                $latitudePickup = $data;
            if($key == "longitudePickup")
                $longitudePickup = $data;
            if($key == "dropOffLocation")
                $dropOffLocation = $data;
            if($key == "latitudeDropOff")
                $latitudeDropOff = $data;
            if($key == "longitudeDropOff")
                $longitudeDropOff = $data;
            if($key == "XpressBag")
                $XpressBag = $data;
            if($key == "BuyForYou")
                $BuyForYou = $data;
            if($key == "ReturnTrip")
                $ReturnTrip = $data;
            if($key == "orderPrice")
                $orderPrice = $data;
            if($key == "receiverName")
                $receiverName = $data;
            if($key == "receiverPhone")
                $receiverPhone = $data;
        }
        Order::create([
            'vehicle_id' => $vehicle_id,
            'id' => Auth::user()->id,
            'order_pickup_location' => $pickUpLocation,
            'order_dropoff_location' => $dropOffLocation,
            'pickup_location_latitude' => $latitudePickup,
            'pickup_location_longitude' => $longitudePickup,
            'dropoff_location_latitude' => $latitudeDropOff,
            'dropoff_location_longitude' => $longitudeDropOff,
            'receiver_name' => $receiverName,
            'receiver_phone' => $receiverPhone,
            'order_fee' => $orderPrice,
            'order_remarks' => $runnerNote,
            'order_status' => $status,
            'order_date' => $orderDateLater,
            'order_time' => $orderTimeLater,
            'order_type' => $type,
        ]);

        $getLatestOrderID = DB::table('order')->orderBy('order_id', 'DESC')->first();

        //dump($getLatestOrderID->order_id);

        if($XpressBag != null){
            //dump("service both");
            OrderService::create([
                'order_id' => $getLatestOrderID->order_id,
                'service_id' => $xpress,
            ]);
        }
        if($BuyForYou != null){
            //dump("service XpressBag");
            OrderService::create([
                'order_id' => $getLatestOrderID->order_id,
                'service_id' => $buy4u,
            ]);
        }
        if($ReturnTrip != null){
            //dump("service XpressBag");
            OrderService::create([
                'order_id' => $getLatestOrderID->order_id,
                'service_id' => $returntrip,
            ]);
        }

        return redirect('student/showOrderDetails/'.$getLatestOrderID->order_id);
    }

    public function SubmitOrders(Request $req){

        $vehicle_id = null;
        $xpress = 1;
        $buy4u = 2;
        $returntrip = 3;
        $door2door = 4;
        $status = "waiting";
        $type = "on-demand";
        $senderName = null;
        $userPhone = null;
        $receiverName = null;
        $receiverPhone = null;
        $runnerNote = null;
        $pickUpLocation = null;
        $latitudePickup = null;
        $longitudePickup = null;
        $dropOffLocation = null;
        $latitudeDropOff = null;
        $longitudeDropOff = null;
        $XpressBag = null;
        $BuyForYou = null;
        $ReturnTrip = null;
        $DoorToDoor = null;
        $orderPrice = null;
        $orderDate = null;
        $orderTime = null;

        foreach($req->all() as $key => $data) {
//            dump('$Key => ' . $key . ' $data => ' . $data);
            if($key == "vehicle")
                $vehicle_id = $data;
            if($key == "orderDate")
                $orderDate = $data;
            if($key == "orderTime")
                $orderTime = $data;
            if($key == "senderName")
                $senderName = $data;
            if($key == "userPhone")
                $userPhone = $data;
            if($key == "receiverName")
                $receiverName = $data;
            if($key == "receiverPhone")
                $receiverPhone = $data;
            if($key == "runnerNote")
                $runnerNote = $data;
            if($key == "pickUpLocation")
                $pickUpLocation = $data;
            if($key == "latitudePickup")
                $latitudePickup = $data;
            if($key == "longitudePickup")
                $longitudePickup = $data;
            if($key == "dropOffLocation")
                $dropOffLocation = $data;
            if($key == "latitudeDropOff")
                $latitudeDropOff = $data;
            if($key == "longitudeDropOff")
                $longitudeDropOff = $data;
            if($key == "XpressBag")
                $XpressBag = $data;
            if($key == "BuyForYou")
                $BuyForYou = $data;
            if($key == "ReturnTrip")
                $ReturnTrip = $data;
            if($key == "DoorToDoor")
                $DoorToDoor = $data;
            if($key == "orderPrice")
                $orderPrice = $data;
        }
        Order::create([
            'vehicle_id' => $vehicle_id,
            'id' => Auth::user()->id,
            'order_pickup_location' => $pickUpLocation,
            'order_dropoff_location' => $dropOffLocation,
            'pickup_location_latitude' => $latitudePickup,
            'pickup_location_longitude' => $longitudePickup,
            'dropoff_location_latitude' => $latitudeDropOff,
            'dropoff_location_longitude' => $longitudeDropOff,
            'receiver_name' => $receiverName,
            'receiver_phone' => $receiverPhone,
            'order_fee' => $orderPrice,
            'order_remarks' => $runnerNote,
            'order_status' => $status,
            'order_date' => $orderDate,
            'order_time' => $orderTime,
            'order_type' => $type,
        ]);

        $getLatestOrderID = DB::table('order')->orderBy('order_id', 'DESC')->first();

        //dump($getLatestOrderID->order_id);

        if($XpressBag != null){
            //dump("service both");
            OrderService::create([
                'order_id' => $getLatestOrderID->order_id,
                'service_id' => $xpress,
            ]);
        }
        if($BuyForYou != null){
            //dump("service XpressBag");
            OrderService::create([
                'order_id' => $getLatestOrderID->order_id,
                'service_id' => $buy4u,
            ]);
        }
        if($ReturnTrip != null){
            //dump("service XpressBag");
            OrderService::create([
                'order_id' => $getLatestOrderID->order_id,
                'service_id' => $returntrip,
            ]);
        }
        if($DoorToDoor != null){
            //dump("service XpressBag");
            OrderService::create([
                'order_id' => $getLatestOrderID->order_id,
                'service_id' => $door2door,
            ]);
        }

        return redirect('student/showOrderDetails/'.$getLatestOrderID->order_id);
    }

    public function showActiveOrder(){

        $userID = Auth::user()->id;

        $activeOrder = DB::table('order')
            ->whereIn('order_status', ['waiting', 'on-going', 'picked-up'])
            ->where('id', '=', $userID)
            ->get();

        return view('student.activeOrder', compact('activeOrder'));
    }

    public function showOrderDetails(Request $req, $id){

        $OrderDetails = DB::table('order')
            ->where('order_id', '=', $id)
            ->get();

        $OrderServiceDetails = DB::table('order_service')
            ->join('additional_services', 'order_service.service_id', '=', 'additional_services.service_id')
            ->where('order_id', '=', $id)
            ->select('additional_services.service_id', 'additional_services.service_name')
            ->get();

        $userID = Auth::user()->id;

        $isRunnerAlreadyFavourite = null;

        foreach($OrderDetails as $items){
            $isRunnerAlreadyFavourite = DB::table('order')
            ->where('id', '=', $userID)
            ->where('runner_id', '=', $items->runner_id)
            ->where('favourite', '=', '1')
            ->count();

            $runnerTelephone = DB::table('users')
                ->join('runner', 'runner.user_id', '=', 'users.id')
                ->join('order', 'order.runner_id', '=', 'runner.runner_id')
                ->where('order.runner_id', '=', $items->runner_id)
                ->select('users.user_phone', 'users.name')
                ->distinct()
                ->get();

//            dump($runnerTelephone);
        }

        return view('student.orderDetail', compact('OrderDetails', 'OrderServiceDetails', 'isRunnerAlreadyFavourite', 'runnerTelephone'));
    }

    public function showOrderRecords(){

        $userId = Auth::id();

        $AllOrder = DB::table('order')
            // ->whereIn('order_status', ['completed', 'cancelled'])
            ->where('id', '=', $userId)
            ->get();

        $CompleteOrder = DB::table('order')
            ->where('order_status', '=','completed')
            ->where('id', '=', $userId)
            ->get();

        $CancelledOrder = DB::table('order')
            ->where('order_status', '=','cancelled')
            ->where('id', '=', $userId)
            ->get();

        $CancelledOrder = DB::table('order')
            ->where('order_status', '=','cancelled')
            ->where('id', '=', $userId)
            ->get();

        $WalkOrder = DB::table('order')
            ->where('vehicle_id', '=','1')
            ->where('id', '=', $userId)
            ->get();

        $MotorOrder = DB::table('order')
            ->where('vehicle_id', '=','2')
            ->where('id', '=', $userId)
            ->get();

        $CarOrder = DB::table('order')
            ->where('vehicle_id', '=','3')
            ->where('id', '=', $userId)
            ->get();

        return view('student.pastOrder', compact('AllOrder','CompleteOrder','CancelledOrder','WalkOrder','MotorOrder','CarOrder'));
    }

    public function showAllOrderRecords(){

        $userId = Auth::id();

        $OrderCount = DB::table('order')
            ->whereIn('order_status', ['completed', 'cancelled'])
            ->where('id', '=', $userId)
            ->count();

        if($OrderCount <= 0)
            return response()->json($OrderCount, 200);

        $Order = DB::table('order')
            ->whereIn('order_status', ['completed', 'cancelled'])
            ->where('id', '=', $userId)
            ->get();

        return response()->json($Order, 200);

        //return view('student.pastOrder', compact('Order'));
    }

    public function showCompletedOrderRecords(){
        $userId = Auth::id();

        $OrderCount = DB::table('order')
            ->where('order_status', '=','completed')
            ->where('id', '=', $userId)
            ->count();

        if($OrderCount <= 0)
            return response()->json($OrderCount, 200);

        $Order = DB::table('order')
            ->where('order_status', '=','completed')
            ->where('id', '=', $userId)
            ->get();

        return response()->json($Order, 200);

        //return view('student.pastOrder', compact('Order'));
    }

    public function showCancelledOrderRecords(){
        $userId = Auth::id();

        $OrderCount = DB::table('order')
            ->where('order_status', '=','cancelled')
            ->where('id', '=', $userId)
            ->count();

        if($OrderCount <= 0)
            return response()->json($OrderCount, 200);

        $Order = DB::table('order')
            ->where('order_status', '=','cancelled')
            ->where('id', '=', $userId)
            ->get();

        return response()->json($Order, 200);

//        return view('student.pastOrder', compact('pastOrder'));
    }

    public function showOrderRecordDetails(Request $req, $id){

        $pastOrderDetails = DB::table('order')
            ->where('order_id', '=', $id)
            ->get();

        $OrderServiceDetails = DB::table('order_service')
            ->join('additional_services', 'order_service.service_id', '=', 'additional_services.service_id')
            ->where('order_id', '=', $id)
            ->select('additional_services.service_id', 'additional_services.service_name')
            ->get();

        $userID = Auth::user()->id;

        $isRunnerAlreadyFavourite = null;

        foreach($pastOrderDetails as $items){
            $isRunnerAlreadyFavourite = DB::table('order')
                ->where('id', '=', $userID)
                ->where('runner_id', '=', $items->runner_id)
                ->where('favourite', '=', '1')
                ->count();

            $runnerTelephone = DB::table('users')
                ->join('runner', 'runner.user_id', '=', 'users.id')
                ->join('order', 'order.runner_id', '=', 'runner.runner_id')
                ->where('order.runner_id', '=', $items->runner_id)
                ->select('users.user_phone', 'users.name')
                ->distinct()
                ->get();

//            dump($runnerTelephone);
        }

        return view('student.pastOrderDetail', compact('pastOrderDetails', 'OrderServiceDetails', 'isRunnerAlreadyFavourite', 'runnerTelephone'));
    }

    public function showFavouriteRunners(){

        $i = 1;
        $userId = Auth::id();
        $runnerArray = array();

        $favOrderCount = DB::table('order')
            ->where('favourite', '=', 1)
            ->where('id', '=', $userId)
            ->select('runner_id')
            ->distinct()
            ->count();

        if($favOrderCount <= 0)
            return view('student.favouriteRunner', compact('runnerArray', 'i', 'favOrderCount'));

        $favOrder = DB::table('order')
            ->where('favourite', '=', 1)
            ->where('id', '=', $userId)
            ->select('runner_id')
            ->distinct()
            ->get();

        foreach ($favOrder as $item){
//            dump('runner id => '.$item->runner_id);
            $runnerDetails = DB::table('runner')
                ->join('users', 'runner.user_id', '=', 'users.id')
                ->join('students', 'users.email', '=', 'students.student_email')
                ->where('runner.runner_id', '=', $item->runner_id)
                ->select('users.*', 'students.*', 'runner.*')
                ->get();

            foreach ($runnerDetails as $items){
                array_push($runnerArray, $items);
            }
        }

        return view('student.favouriteRunner', compact('runnerArray', 'i', 'favOrderCount'));
    }

    public function showFavouriteRunnerDetails(Request $req, $id){

//        dump($id);

        $runnerDetails = DB::table('runner')
            ->join('users', 'users.id', '=', 'runner.user_id')
            ->join('runner_vehicle', 'runner_vehicle.runner_id', '=', 'runner.runner_id')
            ->join('students', 'students.student_email', '=', 'users.email')
            ->where('runner.runner_id', '=', $id)
            ->select('users.*', 'students.*', 'runner.*', 'runner_vehicle.*', )
            ->get();

//        foreach($runnerDetails as $item){
//            dump($item);
//        }

        return view('student.favouriteRunnerDetail', compact('runnerDetails'));

    }

    public function addIcStudent(Request $req){

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

        return redirect()->back()->with('success', 'Identification Card image has been added');
    }

    public function addImageStudent(Request $req){
        $userID = Auth::user()->id;

//        $destinationPath = 'user_image';
//
//        $files=$req->file('UserImage');
//        $name = $files->getClientOriginalName();
//        $size = $files->getSize();
//
//        $path = $files->move($destinationPath,$name);

//        dump($path);
        User::where('id', $userID)
            ->update([
                'user_picture' => $req->input('UserImageUrl'),
            ]);

        return redirect()->back()->with('success', 'Personal image has been added');
    }

    public function updateOrderRating(Request $req, $id){

        if(!$req->has('rate'))
            return redirect()->back()->with('error', 'Please do not leave the rate empty');
        else
        {
            Order::where('order_id', $id)
                ->update([
                    'user_rating' => $req->input('rate'),
                    'user_review' => $req->input('runnerReview'),
                ]);

            return redirect()->back()->with('success', 'Order has successfully rated');
        }
    }

    public function cancelOrder($id){

        $cancel = 'cancelled';
        $userID = Auth::user()->id;
        Order::where('order_id', $id)
            ->update([
                'order_status' => $cancel,
            ]);

        return redirect()->back()->with('cancelled', 'Order has successfully cancelled!');
    }

    public function addToFavourite($rid, $id){

        $userID = Auth::user()->id;
        $one = 1;

        Order::where('order_id', $id)
            ->update([
                'favourite' => $one,
            ]);

        return redirect()->back()->with('success', 'Runner has successfully added to favourite!');
    }

    public function showRoute($id){
        $OrderDetails = DB::table('order')
            ->where('order_id', '=', $id)
            ->select('order_id','pickup_location_latitude','pickup_location_longitude','dropoff_location_latitude','dropoff_location_longitude')
            ->first();

        return view('auth.map', compact('OrderDetails'));
    }
}

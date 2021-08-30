<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RunnerController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!cls
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/maps', [HomeController::class, 'testDistance']);


//User Profile Routing
Route::get('/home', [HomeController::class, 'index'])->middleware(['auth', 'verified']);
//Home routing
Route::get('/runner/home', [RunnerController::class, 'jobListing'])->middleware(['auth', 'verified']);
Route::get('/admin/home', [AdminController::class, 'data'])->middleware(['auth', 'verified']);
Route::get('/staff/home', function () {
    return view('staff.home');
})->middleware(['auth', 'verified']);
Route::get('/student/home', function () {
    return view('student.home');
})->middleware(['auth', 'verified']);

//Profile routing
Route::get('/student/profile', [HomeController::class, 'userInfo'])->middleware(['auth', 'verified']);
Route::get('/staff/profile', [HomeController::class, 'userInfo'])->middleware(['auth', 'verified']);
Route::get('/runner/profile', [HomeController::class, 'userInfo'])->middleware(['auth', 'verified']);
Route::get('/admin/profile', [HomeController::class, 'userInfo'])->middleware(['auth', 'verified']);

//Runner routing

Route::post('/runner/insertRunnerVehicle', [RunnerController::class, 'addRunnerVehicle']);
Route::post('/runner/updateRunnerVehicle', [RunnerController::class, 'updateRunnerVehicle']);

Route::post('/runner/insertRunnerLicense', [RunnerController::class, 'addRunnerLicense']);
Route::post('/runner/updateRunnerLicense', [RunnerController::class, 'updateRunnerLicense']);

Route::post('/runner/insertRunnerImage', [RunnerController::class, 'addRunnerImage']);
Route::get('/runner/addVehicle', [HomeController::class, 'userInfo']);
Route::get('/runner/newOrderDetail/{id}', [RunnerController::class, 'newOrderDetails'])->middleware(['auth', 'verified']);
Route::get('/runner/takeOrder/{id}', [RunnerController::class, 'takeNewOrder'])->middleware(['auth', 'verified']);
Route::get('/runner/onGoingOrder', [RunnerController::class, 'showOnGoingOrder'])->middleware(['auth', 'verified']);
Route::get('/runner/showOnGoingOrderDetail/{id}', [RunnerController::class, 'showOnGoingOrderDetails'])->middleware(['auth', 'verified']);
Route::get('/runner/updateOrderPickedUp/{id}', [RunnerController::class, 'updateOrderPickUp'])->middleware(['auth', 'verified']);
Route::get('/runner/completeOrder/{id}', [RunnerController::class, 'updateOrderComplete'])->middleware(['auth', 'verified']);
Route::get('/runner/completedOrder', [RunnerController::class, 'completedOrder'])->middleware(['auth', 'verified']);
Route::get('/runner/completedOrderDetail/{id}', [RunnerController::class, 'showCompletedOrderDetails'])->middleware(['auth', 'verified']);
Route::post('/runner/rateOrder/{id}', [RunnerController::class, 'updateOrderRating'])->middleware(['auth', 'verified']);
Route::get('/runner/earning', [RunnerController::class, 'showEarnings'])->middleware(['auth', 'verified']);
Route::get('/runner/showAllOrderRecord', [RunnerController::class, 'showAllOrderRecords'])->middleware(['auth', 'verified']);
Route::get('/runner/showCompletedOrderRecord', [RunnerController::class, 'showCompletedOrderRecords'])->middleware(['auth', 'verified']);
Route::get('/runner/showCancelledOrderRecord', [RunnerController::class, 'showCancelledOrderRecords'])->middleware(['auth', 'verified']);
Route::get('/runner/showRoute/{id}', [RunnerController::class, 'showRoute'])->middleware(['auth', 'verified']);
Route::get('/runner/findOrder/{id}', [RunnerController::class, 'testFindOrder'])->middleware(['auth', 'verified']);
Route::get('/runner/sendsms', [RunnerController::class, 'sendsms'])->middleware(['auth', 'verified']);

//Student routing
Route::post('/student/insertImage', [StudentController::class, 'addImageStudent'])->middleware(['auth', 'verified']);
Route::post('/student/insertIcImage', [StudentController::class, 'addIcStudent'])->middleware(['auth', 'verified']);
//Order ~ Walk
Route::post('/student/createOrderWalk', [StudentController::class, 'createOrderWalks'])->middleware(['auth', 'verified']);
Route::get('/student/setOrderDateTime/{arr}', [StudentController::class, 'processOrderWalks'])->middleware(['auth', 'verified']);
//Order ~ Motor
Route::post('/student/createOrderMotor', [StudentController::class, 'createOrderMotors'])->middleware(['auth', 'verified']);
Route::get('/student/setOrderDateTimeMotor/{arr}', [StudentController::class, 'processOrderMotors'])->middleware(['auth', 'verified']);
//Order ~ Car
Route::post('/student/createOrderCar', [StudentController::class, 'createOrderCars'])->middleware(['auth', 'verified']);
Route::get('/student/setOrderDateTimeCar/{arr}', [StudentController::class, 'processOrderCars'])->middleware(['auth', 'verified']);
Route::post('/student/submitOrder', [StudentController::class, 'SubmitOrders'])->middleware(['auth', 'verified']);
Route::post('/student/SubmitOrderLater', [StudentController::class, 'SubmitOrderLaters'])->middleware(['auth', 'verified']);
Route::get('/student/activeOrder', [StudentController::class, 'showActiveOrder'])->middleware(['auth', 'verified']);
Route::get('/student/showOrderDetails/{id}', [StudentController::class, 'showOrderDetails'])->middleware(['auth', 'verified']);
Route::get('/student/showOrderRecord', [StudentController::class, 'showOrderRecords'])->middleware(['auth', 'verified']);
Route::get('/student/showOrderRecord/{id}', [StudentController::class, 'showOrderRecordDetails'])->middleware(['auth', 'verified']);
Route::get('/student/showAllOrderRecord', [StudentController::class, 'showAllOrderRecords'])->middleware(['auth', 'verified']);
Route::get('/student/showCompletedOrderRecord', [StudentController::class, 'showCompletedOrderRecords'])->middleware(['auth', 'verified']);
Route::get('/student/showCancelledOrderRecord', [StudentController::class, 'showCancelledOrderRecords'])->middleware(['auth', 'verified']);
Route::get('/student/showFavouriteRunner', [StudentController::class, 'showFavouriteRunners'])->middleware(['auth', 'verified']);
Route::get('/student/showFavouriteRunnerDetail/{id}', [StudentController::class, 'showFavouriteRunnerDetails'])->middleware(['auth', 'verified']);
Route::post('/student/rateOrder/{id}', [StudentController::class, 'updateOrderRating'])->middleware(['auth', 'verified']);
Route::get('/student/cancelOrder/{id}', [StudentController::class, 'cancelOrder'])->middleware(['auth', 'verified']);
Route::get('/student/addToFavourite/{rid}/{id}', [StudentController::class, 'addToFavourite'])->middleware(['auth', 'verified']);
Route::get('/student/showRoute/{id}', [StudentController::class, 'showRoute'])->middleware(['auth', 'verified']);

//Staff routing
Route::post('/staff/insertImage', [StaffController::class, 'addImageStaff'])->middleware(['auth', 'verified']);
Route::post('/staff/insertIcImage', [StaffController::class, 'addIcStaff'])->middleware(['auth', 'verified']);
Route::post('/staff/createOrderWalk', [StaffController::class, 'createOrderWalks'])->middleware(['auth', 'verified']);
Route::get('/staff/setOrderDateTime/{arr}', [StaffController::class, 'processOrderWalks'])->middleware(['auth', 'verified']);
Route::post('/staff/createOrderMotor', [StaffController::class, 'createOrderMotors'])->middleware(['auth', 'verified']);
Route::get('/staff/setOrderDateTimeMotor/{arr}', [StaffController::class, 'processOrderMotors'])->middleware(['auth', 'verified']);
Route::post('/staff/createOrderCar', [StaffController::class, 'createOrderCars'])->middleware(['auth', 'verified']);
Route::get('/staff/setOrderDateTimeCar/{arr}', [StaffController::class, 'processOrderCars'])->middleware(['auth', 'verified']);
Route::post('/staff/submitOrder', [StaffController::class, 'SubmitOrders'])->middleware(['auth', 'verified']);
Route::post('/staff/SubmitOrderLater', [StaffController::class, 'SubmitOrderLaters'])->middleware(['auth', 'verified']);
Route::get('/staff/activeOrder', [StaffController::class, 'showActiveOrder'])->middleware(['auth', 'verified']);
Route::get('/staff/showOrderDetails/{id}', [StaffController::class, 'showOrderDetails'])->middleware(['auth', 'verified']);
Route::get('/staff/showOrderRecord', [StaffController::class, 'showOrderRecords'])->middleware(['auth', 'verified']);
Route::get('/staff/showOrderRecord/{id}', [StaffController::class, 'showOrderRecordDetails'])->middleware(['auth', 'verified']);
Route::get('/staff/showAllOrderRecord', [StaffController::class, 'showAllOrderRecords'])->middleware(['auth', 'verified']);
Route::get('/staff/showCompletedOrderRecord', [StaffController::class, 'showCompletedOrderRecords'])->middleware(['auth', 'verified']);
Route::get('/staff/showCancelledOrderRecord', [StaffController::class, 'showCancelledOrderRecords'])->middleware(['auth', 'verified']);
Route::get('/staff/showFavouriteRunner', [StaffController::class, 'showFavouriteRunners'])->middleware(['auth', 'verified']);
Route::get('/staff/showFavouriteRunnerDetail/{id}', [StaffController::class, 'showFavouriteRunnerDetails'])->middleware(['auth', 'verified']);
Route::post('/staff/rateOrder/{id}', [StaffController::class, 'updateOrderRating'])->middleware(['auth', 'verified']);
Route::get('/staff/cancelOrder/{id}', [StaffController::class, 'cancelOrder'])->middleware(['auth', 'verified']);
Route::get('/staff/addToFavourite/{rid}/{id}', [StaffController::class, 'addToFavourite'])->middleware(['auth', 'verified']);
Route::get('/staff/showRoute/{id}', [StaffController::class, 'showRoute'])->middleware(['auth', 'verified']);
Route::get('/staff/map', [StaffController::class, 'map'])->middleware(['auth', 'verified']);

Route::get('/staff/testupload', function () {
    return view('staff.uploadImage');
})->middleware(['auth', 'verified']);

Route::post('/staff/getImg', [StaffController::class, 'getupload'])->middleware(['auth', 'verified']);

//Admin routing
Route::post('/admin/insertImage', [AdminController::class, 'addImageAdmin'])->middleware(['auth', 'verified']);
Route::post('/admin/insertIcImage', [AdminController::class, 'addIcAdmin'])->middleware(['auth', 'verified']);
Route::get('/admin/manageUser', [AdminController::class, 'manageUser'])->middleware(['auth', 'verified']);
Route::get('/admin/manageRunner', [AdminController::class, 'manageRunner'])->middleware(['auth', 'verified']);
Route::get('/admin/manageOrder', [AdminController::class, 'manageOrder'])->middleware(['auth', 'verified']);
Route::get('/admin/manageAdmin', [AdminController::class, 'manageAdmin'])->middleware(['auth', 'verified']);
Route::get('/admin/deactivateUser/{id}', [AdminController::class, 'deactivateUser'])->middleware(['auth', 'verified']);
Route::get('/admin/deactivateAdmin/{email}', [AdminController::class, 'deactivateAdmin'])->middleware(['auth', 'verified']);
Route::get('/admin/activateAdmin/{email}', [AdminController::class, 'activateAdmin'])->middleware(['auth', 'verified']);
Route::get('/admin/activateUser/{id}', [AdminController::class, 'activateUser'])->middleware(['auth', 'verified']);
Route::get('/admin/cancelOrder/{id}', [AdminController::class, 'cancelOrder'])->middleware(['auth', 'verified']);
Route::get('/admin/orderDetails/{id}', [AdminController::class, 'showOrderDetails'])->middleware(['auth', 'verified']);
Route::get('/admin/showRoute/{id}', [AdminController::class, 'showRoute'])->middleware(['auth', 'verified']);
Route::get('/admin/userDetails/{id}', [AdminController::class, 'showUserDetails'])->middleware(['auth', 'verified']);
Route::get('/admin/runnerDetails/{id}', [AdminController::class, 'showRunnerDetails'])->middleware(['auth', 'verified']);
Route::get('/admin/runnerDetails2/{id}', [AdminController::class, 'showRunnerDetailsButton'])->middleware(['auth', 'verified']);
Route::get('/admin/adminDetails/{email}', [AdminController::class, 'showAdminDetails'])->middleware(['auth', 'verified']);
Route::post('/admin/addNewAdmin', [AdminController::class, 'addNewAdmin'])->middleware(['auth', 'verified']);
Route::post('/admin/addNewStudent', [AdminController::class, 'addNewStudent'])->middleware(['auth', 'verified']);
Route::post('/admin/addNewStaff', [AdminController::class, 'addNewStaff'])->middleware(['auth', 'verified']);




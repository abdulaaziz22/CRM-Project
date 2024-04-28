<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{
    CollegeController,
    BuildingController,
    RoomTypeController,
    RoomController,
    RequestController,
    RequestStatusController,
    PriorityController,
    CategoryController,
    AuthController,
    UserTypeController,
    TrackingController,
    NotificationController
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Broadcast::routes(['middleware' => ['auth:sanctum']]);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('College',CollegeController::class);
    Route::apiResource('Building',BuildingController::class);
    Route::apiResource('RoomType',RoomTypeController::class);
    Route::apiResource('Room',RoomController::class);
    Route::apiResource('Request',RequestController::class);
    Route::apiResource('RequestStatus',RequestStatusController::class);
    Route::apiResource('Priority',PriorityController::class);
    Route::apiResource('Category',CategoryController::class);
    Route::apiResource('Tracking',TrackingController::class);
    Route::apiResource('UserType',UserTypeController::class);
    Route::post('logout',[AuthController::class,'logout']);
    Route::get('user',[AuthController::class,'index']);
    Route::get('Notifications/unread',[NotificationController::class,'UnreadNotifications']);
    Route::get('Notifications/all',[NotificationController::class,'AllNotifications']);


});

Route::group(['middleware' => ['guest:sanctum']], function () {
    Route::post('register',[AuthController::class,'register']);
    Route::post('login',[AuthController::class,'login']);
});








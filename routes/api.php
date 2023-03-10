<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Http\Controllers\loginlinkController;
use App\Http\Controllers\emergencyleaveController;







/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('requestlogin',[loginController::class,'requestpin']);
Route::post('verifylogin',[loginController::class,'verifypin']);
Route::post('requestloginlink',[loginlinkController::class,'requestlink']);
Route::post('verifyloginlink',[loginlinkController::class,'verifylink']);
Route::post('user_profile',[loginController::class,'profileData']);



Route::group(['middleware' => 'emergencyleave'],function(){
Route::post('emergencyleave',[emergencyleaveController::class,'leave']);
Route::post('upload_document',[emergencyleaveController::class,'leaveAttechements']);  
Route::post('get_user_leave',[emergencyleaveController::class,'getLeave']);
Route::post('updatedetailes',[loginController::class,'update']);
Route::post('logout',[loginController::class,'logoutUser']);
});



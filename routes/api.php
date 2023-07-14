<?php

use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\Auth\RegisterController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix'=>'user'],function(){
    Route::post('register',[RegisterController::class ,'register']);
    Route::post('login',[LoginController::class ,'login']);
    Route::get('logout',[LoginController::class ,'logout']);
    Route::post('verify-phone',[RegisterController::class ,'verifyPhoneNumber']);
    Route::post('resend-code',[RegisterController::class ,'resendCode']);

    Route::group(['prefix'=>'profile'],function(){
        Route::get('/',[ProfileController::class,'getProfile']);
        Route::post('edit-user-name',[ProfileController::class,'editUserName']);
        Route::post('change-password',[ProfileController::class,'changePassword']);
    });
});


Route::get('test',function(Request $request){
   return  auth('admin')->user();



    // $response = Http::attach(
    //     'image', file_get_contents($request->image), $request->image->getClientOriginalName()
    // )->post('localhost:8080/api/category',$request->only('name_en','description_en'));
    // return $response->status() ;
});


Route::post('test-show',function(Request $request){
    $response = Http::get('localhost:8080/api/category/8');
    return $response->json() ;
});

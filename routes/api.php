<?php

use App\Http\Controllers\API\ApiController;
use App\Models\CmsPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::namespace('App\Http\Controllers\API')->group(function () {
    // REGISTER USER FOR REACT APP

    Route::controller(ApiController::class)->group(function(){
        Route::post('register-user','registerUser');
        Route::post('login-user','loginUser');

        // update user detail
        Route::post('update-user', 'updateUser');
        // get category
        Route::get('menu', 'menuCategory');
        // Cms Pages Route
        $cmsUrl = CmsPage::select('url')->where('status' , 1)->get()->pluck('url')->toArray();
        foreach($cmsUrl as $url){
            Route::get($url, 'cmsPage');
        }
    });
});

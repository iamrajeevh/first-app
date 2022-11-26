<?php

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
// */
Route::controller(Controller::class)->group(function(){
    Route::get('get-check-sum','CheckSum');
    Route::get('get-post','getPost');
    Route::post('create-post','storePost');
    Route::post('delete-post','deletePost');
    Route::get('get-view', 'dataFromView');
    Route::get('file-download','fd');
    Route::get('export-users','ExportUsers');
    Route::post('edit-files','EditFiles');

});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::Fallback(function () {
    return response()->json('You have tried to access something critical',401);
 });
 Route::any('/{any}', function(Request $request) {

     return 'Kindly check your url,method or parameters. May be you are forgotten'; //or any other route preferred
 })
 ->where('any', '.*');


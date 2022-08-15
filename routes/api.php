<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthCcontroller;
use App\Http\Controllers\AdminCcontroller;
use App\Http\Controllers\VisitorController;

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

Route::post('/auth/register', [AuthCcontroller::class, 'register']);
Route::post('/auth/login', [AuthCcontroller::class, 'login']);


Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/me', function(Request $request){
        return auth()->user();
    });
    //Routes for Administrator
    Route::post('/auth/logout', [AuthCcontroller::class, 'logout']);
    Route::delete('/remove/{id}', [AdminCcontroller::class, 'remove']);
    Route::get('/soft/delete/{id}', [AdminCcontroller::class, 'softdelete']);
    Route::get('/trashed/{id}', [AdminCcontroller::class, 'trashed']);

    //Route for Visitors to to get their data based on their token.
    Route::get('/get-profile', [VisitorController::class, 'getProfil']); 
   
});







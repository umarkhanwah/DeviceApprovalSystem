<?php

use App\Http\Controllers\AuthController;
use App\Models\Device;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::post('/register' , [AuthController::class , 'register'])->name('signup.register');
Route::get('/register' , function(){
    return view('register');
});
Route::get('/allusers' , function(){
   $users = User::all();
   
   
    return response()->json($users);
});
Route::get('/alldevices' , function(){
   $users = Device::all();
    return response()->json($users);
});

Route::get('/test-me', function() {
    return "Routes are working!";
});


Route::get('/login', function() {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');


Route::get('/admin/dashboard', [AuthController::class, 'adminDashboard'])->name('admin.dashboard');
Route::post('/admin/device/toggle/{id}', [AuthController::class, 'toggleApproval'])->name('device.toggle');
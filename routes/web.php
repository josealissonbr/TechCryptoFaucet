<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Http\Request;
//Use Routes
use App\Http\Controllers\AuthController;

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
    return view('app');
});

Route::get('admin', function () {
    return view('admin.app');
})->name('admin.home');

Route::get('login/redirector', function () {
    if (Auth::Check())
        return 'Authentication validated!';
    else
        return 'Authentication validation failed!';
})->name('login.redirector');

Route::get('dashboard', function () {
})->name('dashboard');

Route::get('auth/login/view', function() {
    return view('auth.login');
});

Route::get('sub-api/auth/logout', function(Request $request) {
    if (Auth::Check()){
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();

        return response()->json([
            'status'    =>  'success'
        ]);
    }else{
        return response()->json([
            'status'    =>  'failed'
        ]);
    }
});

Route::post('auth/login', [AuthController::class, 'doLogin']);

//Route::get('login', [AuthController::class, 'index'])->name('login');

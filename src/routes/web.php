<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Providers\FortifyServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

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

Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/thanks', [ContactController::class, 'store']);

Route::get('/admin', [ContactController::class, 'admin'])->middleware('auth');
Route::post('/admin/search', [ContactController::class, 'search'])->middleware('auth');
Route::delete('/admin/delete', [ContactController::class, 'destroy'])->middleware('auth');
Route::post('/admin/download', [ContactController::class, 'download'])->middleware('auth');
/*
Route::get('/login', function () {
    Auth::logout();
    return view('auth.login');
})->middleware('auth');
*/

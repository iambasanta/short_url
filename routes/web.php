<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\UrlController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;

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

Route::view('/', 'welcome');
//for login and register
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);


Route::apiResources([
    'url' => UrlController::class,
]);

Route::post('/password/reset-link-email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
Route::post('/password/reset', [ResetPasswordController::class, 'reset']);
//{url} is for id 
Route::get('u/{url}', [UrlController::class, 'show']);
Route::any('{url}', function () {
    return view('welcome');
})->where('url', '.*');


Route::post('password/reset/{token}', function () {
    return '';
})->name('password.reset');

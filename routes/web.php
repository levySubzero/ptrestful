<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InterfaceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();


// Route::post('/logout', [InterfaceController::class, 'index']);
Route::get('password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetCodeEmail'])->name('password.email');
Route::get('password/code-verify', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'codeVerify'])->name('password.code.verify');
Route::post('password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');
Route::get('password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/verify-code', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'verifyCode'])->name('password.verify.code');
Route::post('password/reset/change', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.change');

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/addInfo/{id?}', [App\Http\Controllers\HomeController::class, 'addInfo'])->name('info.add');
Route::get('/newInfo/{id?}', [App\Http\Controllers\HomeController::class, 'newInfo'])->name('info.new');
Route::get('/allInfo', [App\Http\Controllers\HomeController::class, 'allInfo'])->name('info.all');
Route::put('/saveInfo/{id?}', [App\Http\Controllers\HomeController::class, 'updateInfo'])->name('info.update');
Route::post('/storeInfo', [App\Http\Controllers\HomeController::class, 'storeInfo'])->name('info.store');
Route::get('/deleteInfo/{id}', [App\Http\Controllers\HomeController::class, 'destroy'])->name('info.delete');
// Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');

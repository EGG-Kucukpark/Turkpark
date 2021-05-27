<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\EmailController;

use App\Http\Controllers\ClientController;

use App\Http\Controllers\TodoController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\UserController;








Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('logout', [AuthController::class, 'logout']);
});


////////////////////////////////////////////////////////////////////////////////////
//                      Kullanıcı İşlemleri
Route::post('users', [UserController::class, 'getuser']);
Route::post('userupdate', [UserController::class, 'updateuser']);
route::post('userekle', [UserController::class, 'adduser']);
route::post('status', [UserController::class, 'status']);

////////////////////////////////////////////////////////////////////////////////////
//                      Firma İşlemleri

Route::get('firmagoster/{id}', [clientController::class, 'client']);
Route::post('nace', [clientController::class, 'getnace']);
route::post('firmaekle', [clientController::class, 'addclient']);
route::post('firmaduzenle', [clientController::class, 'firmaduzenle']);

route::post('firmalar', [clientController::class, 'getclients']);
route::post('firmanotekle', [clientController::class, 'notekle']);
route::post('firmanotsil', [clientController::class, 'notsil']);
route::post('firmanot', [clientController::class, 'notlar']);
route::post('firmanotduzenle', [clientController::class, 'notdüzenle']);



////////////////////////////////////////////////////////////////////////////////////
//                      Bireysel İşlemler
Route::get('bireyselgöster/{id}', [clientController::class, 'client']);
route::post('bireyselekle', [clientController::class, 'addindividual']);
route::post('bireyselduzenle', [clientController::class, 'editindividual']);

route::post('bireyseller', [clientController::class, 'getindividual']);


////////////////////////////////////////////////////////////////////////////////////
//                      Çalışan İşlemleri

Route::get('calisangoster/{id}', [WorkerController::class, 'worker']);
Route::post('calisanlar', [WorkerController::class, 'workers']);
Route::post('belgeyukle', [WorkerController::class, 'upload']);
Route::post('getfile', [WorkerController::class, 'getfile']);
Route::post('showfile', [WorkerController::class, 'showfile']);
Route::post('indir', [WorkerController::class, 'download']);
route::post('calisanekle', [WorkerController::class, 'addworker']);
route::post('dosyasil', [WorkerController::class, 'deletefile']);

////////////////////////////////////////////////////////////////////////////////////
//                      Todo İşlemleri

Route::get('tasks', [TodoController::class, 'tasks']);
Route::post('addtask', [TodoController::class, 'addtask']);
Route::post('deletetask/{id}', [TodoController::class, 'deletetask']);
Route::post('updatetask/{id}', [TodoController::class, 'updatetask']);

////////////////////////////////////////////////////////////////////////////////////
//                      Email İşlemleri

Route::post('email', [EmailController::class, 'email']);
Route::group(['middleware' => 'guest:api'], function () {
    Route::post('email/verify/{user}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend']);
    Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [ResetPasswordController::class, 'reset']);
});

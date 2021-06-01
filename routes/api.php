<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Email\EmailController;

use App\Http\Controllers\Client\ClientController;

use App\Http\Controllers\Apps\TodoController;
use App\Http\Controllers\Apps\CerfController;
use App\Http\Controllers\Worker\WorkerController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\File\FileController;








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
route::post('excelimport', [UserController::class, 'import']);

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
route::post('calisanekle', [WorkerController::class, 'addworker']);

////////////////////////////////////////////////////////////////////////////////////
//                      Dosya İşlemleri
Route::post('belgeyukle', [FileController::class, 'upload']);
Route::post('getfile', [FileController::class, 'getfile']);
Route::post('showfile', [FileController::class, 'showfile']);
Route::post('indir', [FileController::class, 'download']);
route::post('dosyasil', [FileController::class, 'deletefile']);
route::post('excelsertifika', [FileController::class, 'importsertf']);


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



////////////////////////////////////////////////////////////////////////////////////
//                      Sertifika İşlemleri

route::post('sertifikagetir', [CerfController::class, 'get']);
route::get('sertifikagoster/{id}', [CerfController::class, 'sertifika']);


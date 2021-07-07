<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Email\EmailController;

use App\Http\Controllers\Users_all\ClientController;
use App\Http\Controllers\Users_all\BireyController;
use App\Http\Controllers\File\BireyFile;

use App\Http\Controllers\Apps\TodoController;
use App\Http\Controllers\Apps\EduController;
use App\Http\Controllers\Apps\CerfController;
use App\Http\Controllers\Apps\TakvimController;
use App\Http\Controllers\Worker\WorkerController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\File\FileController;
use App\Http\Controllers\File\Birey;









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
route::post('sifreguncelle', [UserController::class, 'sifirla']);
route::post('arsivuser', [UserController::class, 'arsiv']);
Route::post('arsivckr', [UserController::class, 'arsivckr']);
route::post('usersil', [UserController::class, 'delete']);
route::post('getuser', [UserController::class, 'getuserinfo']);




////////////////////////////////////////////////////////////////////////////////////
//                      Firma İşlemleri

Route::get('firmagoster/{id}', [clientController::class, 'client']);
route::post('firmaekle', [clientController::class, 'addclient']);
route::post('firmaduzenle', [clientController::class, 'firmaduzenle']);
route::post('firmalar', [clientController::class, 'getclients']);
route::post('firmanotekle', [clientController::class, 'notekle']);
route::post('firmanotsil', [clientController::class, 'notsil']);
route::post('firmanot', [clientController::class, 'notlar']);
route::post('firmanotduzenle', [clientController::class, 'notdüzenle']);
route::post('arsivfirma', [ClientController::class, 'arsiv']);
route::post('firmaarsvckr', [ClientController::class, 'arsivckr']);
route::post('firmasil', [ClientController::class, 'delete']);




////////////////////////////////////////////////////////////////////////////////////
//                      Bireysel İşlemler
Route::get('bireyselgoster/{id}', [BireyController::class, 'individual']);
route::post('bireyselekle', [BireyController::class, 'addindividual']);
route::post('bireyselduzenle', [BireyController::class, 'editindividual']);
route::post('indarsiv', [BireyController::class, 'indarsiv']);
route::post('bireyarsvckr', [BireyController::class, 'arsivckr']);
route::post('bireyseller', [BireyController::class, 'getindividual']);


////////////////////////////////////////////////////////////////////////////////////
//                      Çalışan İşlemleri

Route::get('calisangoster/{id}', [WorkerController::class, 'worker']);
Route::post('calisanlar', [WorkerController::class, 'workers']);
route::post('calisanekle', [WorkerController::class, 'addworker']);
route::post('calisanduzenle', [WorkerController::class, 'calisanduzenle']);
Route::post('workersil', [WorkerController::class, 'workersil']);

////////////////////////////////////////////////////////////////////////////////////
//                      Dosya İşlemleri -- Firma
Route::post('belgeyukle', [FileController::class, 'upload']);
Route::post('getfile', [FileController::class, 'getfile']);
Route::post('getfile2', [FileController::class, 'getfile2']);
Route::post('showfile', [FileController::class, 'showfile']);
Route::post('indir', [FileController::class, 'download']);
route::post('dosyasil', [FileController::class, 'deletefile']);
route::post('excelsertifika', [FileController::class, 'importsertf']);
Route::post('rapor', [FileController::class, 'getrapor']);
route::post('dosyaarsiv', [FileController::class, 'arsiv']);
route::post('raporlar', [FileController::class, 'raporlar']);
route::post('raporekle', [FileController::class, 'raporekle']);
route::post('raporsil', [FileController::class, 'raporsil']);

////////////////////////////////////////////////////////////////////////////////////
//                      Dosya İşlemleri -- Bireysel
Route::post('bireybelgeyukle', [BireyFile::class, 'upload']);
Route::post('bireygetfile', [BireyFile::class, 'getfile']);
Route::post('bireygetfile2', [BireyFile::class, 'getfile2']);
Route::post('bireyindir', [BireyFile::class, 'download']);
route::post('bireydosyasil', [BireyFile::class, 'deletefile']);
route::post('bireydosyaarsiv', [BireyFile::class, 'arsiv']);

////////////////////////////////////////////////////////////////////////////////////
//                      Todo İşlemleri

Route::get('tasks', [TodoController::class, 'tasks']);
Route::post('addtask', [TodoController::class, 'addtask']);
Route::post('deletetask/{id}', [TodoController::class, 'deletetask']);
Route::post('updatetask/{id}', [TodoController::class, 'updatetask']);

////////////////////////////////////////////////////////////////////////////////////
//                      Takvim İşlemleri

route::post("takvim", [TakvimController::class, 'takvimler']);
route::post("takvimekle", [TakvimController::class, 'takvimekle']);
route::post("takvimduzenle/{id}", [TakvimController::class, 'takvimduzenle']);
route::post("takvimsil", [TakvimController::class, 'takvimsil']);




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

////////////////////////////////////////////////////////////////////////////////////
//                      Eğitim İşlemleri

route::post('egitimgetir', [EduController::class, 'get']);
route::post('kategorigetir', [EduController::class, 'getcategory']);
route::post('kategoriekle', [EduController::class, 'addcategory']);
route::post('kategorisil', [EduController::class, 'delcategory']);

route::post('yergetir', [EduController::class, 'getplace']);
route::post('yerekle', [EduController::class, 'addplace']);
route::post('yersil', [EduController::class, 'delplace']);

route::get('egitimgoster/{id}', [EduController::class, 'view']);
route::post('egitimekle', [EduController::class, 'add']);
route::post('egitimduzenle', [EduController::class, 'update']);
route::post('katilimcigetir', [EduController::class, 'getusers']);
route::post('katilimciekle', [EduController::class, 'addusers']);
route::post('katilimcisil', [EduController::class, 'deleteusers']);
route::post('katilimciduzenle', [EduController::class, 'updateuser']);

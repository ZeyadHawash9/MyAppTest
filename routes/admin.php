
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\LanguageController;

Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/', function () {
        return view('dashboard.index');
    })->name('home');

    Route::group(['prefix' => 'admins','as'=>'admins.'], function () {
        Route::post('/{id}/active', [AdminController::class, 'changeStatus'])->name('status');
        Route::get('/any-data', [AdminController::class, 'anyData'])->name('anyData');

    });


    Route::group(['prefix' => 'categories','as'=>'Categories.'], function () {
        Route::post('/{id}/active', [CategoryController::class, 'changeStatus'])->name('status');
        Route::get('/any-data', [CategoryController::class, 'anyData'])->name('anyData');

    });

    Route::group(['prefix' => 'languages','as'=>'languages.'], function () {
        Route::post('/{id}/active', [LanguageController::class, 'changeStatus'])->name('status');
        Route::get('/any-data', [LanguageController::class, 'anyData'])->name('anyData');

    });


    Route::resources([
        'admins' => AdminController::class,
        'categories' => CategoryController::class,
        'languages' => LanguageController::class,

    ]);




    Route::get('logout/', [AdminLoginController::class,'logout'])->name('logout');

});


Route::get('/login',[AdminLoginController::class,'showLoginForm'])->name('admin.login');
Route::post('/login', [AdminLoginController::class,'login'])->name('admin.login.submit');


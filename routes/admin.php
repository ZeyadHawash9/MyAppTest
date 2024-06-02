
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\BrandController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\LanguageController;
use App\Http\Controllers\Dashboard\RoleController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;



Route::group(['prefix' => LaravelLocalization::setLocale() . '/dashboard','as'=>'dashboard.'], function () {

Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/', function () {
        return view('dashboard.index');
    })->name('home');

    Route::group(['prefix' => 'admins','as'=>'admins.'], function () {
        Route::post('/{admin}/active', [AdminController::class, 'changeStatus'])->name('status');
        Route::get('/any-data', [AdminController::class, 'anyData'])->name('anyData');

    });


    Route::group(['prefix' => 'categories','as'=>'categories.'], function () {
        Route::post('/{category}/active', [CategoryController::class, 'changeStatus'])->name('status');
        Route::get('/any-data', [CategoryController::class, 'anyData'])->name('anyData');

    });

    Route::group(['prefix' => 'languages','as'=>'languages.'], function () {
        Route::post('/{language}/active', [LanguageController::class, 'changeStatus'])->name('status');
        Route::get('/any-data', [LanguageController::class, 'anyData'])->name('anyData');

    });

    Route::group(['prefix' => 'brands','as'=>'brands.'], function () {
        Route::post('/{brand}/active', [BrandController::class, 'changeStatus'])->name('status');
        Route::get('/any-data', [BrandController::class, 'anyData'])->name('anyData');

    });

    Route::group(['prefix' => 'roles','as'=>'roles.'], function () {
        Route::post('/{brand}/active', [RoleController::class, 'changeStatus'])->name('status');
        Route::get('/any-data', [RoleController::class, 'anyData'])->name('anyData');

    });
    Route::resources([
        'admins' => AdminController::class,
        'categories' => CategoryController::class,
        'languages' => LanguageController::class,
        'brands' => BrandController::class,
        'roles' => RoleController::class,


    ]);




    Route::get('logout/', [AdminLoginController::class,'logout'])->name('logout');

});


Route::get('/login',[AdminLoginController::class,'showLoginForm'])->name('admin.login');
Route::post('/login', [AdminLoginController::class,'login'])->name('admin.login.submit');


});

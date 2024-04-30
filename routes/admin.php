
<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;





Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('home');

    Route::group(['prefix' => 'admins','as'=>'admins.'], function () {
        Route::post('/{id}/active', [AdminController::class, 'changeStatus'])->name('status');
    });
    Route::resource('admins', AdminController::class);

    Route::group(['prefix' => 'Categories','as'=>'Categories.'], function () {
        Route::post('/{id}/active', [CategoryController::class, 'changeStatus'])->name('status');
        Route::get('/any-data', [CategoryController::class, 'anyData'])->name('status');

    });
    Route::resource('Categories', CategoryController::class);


});


Route::get('/login',[AdminLoginController::class,'showLoginForm'])->name('admin.login');
Route::post('/login', [AdminLoginController::class,'login'])->name('admin.login.submit');
// Route::get('logout/', 'Auth\AdminLoginController@logout')->name('admin.logout');


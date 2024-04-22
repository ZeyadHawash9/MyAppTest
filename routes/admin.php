
<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('admin.index');
});
Route::group(['prefix' => 'admins','as'=>'admins.'], function () {
    Route::put('/{id}/active', [AdminController::class, 'changeStatus'])->name('status');
});
Route::resource('admins', AdminController::class);

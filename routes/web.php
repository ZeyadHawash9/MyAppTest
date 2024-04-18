<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'where' => ['locale' => '[a-zA-Z]{2}'],
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']

], function () {

    Route::group([
        'prefix' => 'dashboard',
        'as' => 'dashboard.'

    ], function () {
        Route::get('/', function () {
            return view('admin.index');
        });
    });
});

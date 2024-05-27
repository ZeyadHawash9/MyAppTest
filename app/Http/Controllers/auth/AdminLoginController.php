<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminLoginController extends Controller
{


    public function showLoginForm()
    {
        return view('dashboard.auth.layouts.layout');
    }
    public function login(LoginRequest $request)
    {
    
        
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->intended(route('dashboard.home'));
        }

        return Redirect::back()->withErrors([ 'message' => __('Email or password do not match')]);


    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}

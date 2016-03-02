<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function registerOnlyEmail()
    {
    	return view('auth.register-email');
    }

    public function registerSupplier()
    {

    }

    public function activate($activation_code)
    {
    	$data = compact('activation_code');
    	return view('auth.activation_member', $data);
    }
}
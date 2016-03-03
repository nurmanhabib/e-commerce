<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function registerMember()
    {
    	return view('auth.register-email');
    }

    public function registerSupplier()
    {
        return view('auth.register-supplier');
    }

    public function activate($activation_code)
    {
    	$data = compact('activation_code');
    	return view('auth.activation_member', $data);
    }

    public function activateSupplier($activation_code)
    {
        $data = compact('activation_code');
        return view('auth.activation_supplier', $data);
    }
}
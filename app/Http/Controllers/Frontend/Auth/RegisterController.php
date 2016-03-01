<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }
}
<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function user()
    {
        return view('auth.user.login');
    }

     public function admin()
    {
        return view('auth.admin.login');
    }

    public function supplier()
    {
    	return view('auth.supplier.login');
    }

}
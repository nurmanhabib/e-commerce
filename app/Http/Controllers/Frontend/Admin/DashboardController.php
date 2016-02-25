<?php

namespace App\Http\Controllers\Frontend\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function login()
    {
    	return view('auth.admin.login');
    }
}
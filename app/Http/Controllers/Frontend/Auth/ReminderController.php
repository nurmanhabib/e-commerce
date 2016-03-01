<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;

class ReminderController extends Controller
{
    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function reset($token)
    {
    	$data = compact('token');

        return view('auth.reset', $data);
    }
}
<?php


namespace App\Http\Controllers\Frontend\Auth\Social;

use App\Http\Controllers\Controller;

class SocialController extends Controller
{
    public function login()
    {
        return view('front.login-social');
    }
}
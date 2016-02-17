<?php
/**
 * Created by PhpStorm.
 * User: ilma
 * Date: 15/02/2016
 * Time: 16.28
 */

namespace App\Http\Controllers\V1\Admin;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return [
            'status'    => 'success',
            'data'      => User::all(),
        ];
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username'      => 'required|min:3|unique:users',
            'email'         => 'required|email|unique:users',
        ]);
    }

    public function show(User $user)
    {
        return [
            'status'    => 'success',
            'data'      => $user,
        ];
    }
}
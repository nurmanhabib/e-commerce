<?php
/**
 * Created by PhpStorm.
 * User: bihama
 * Date: 14/02/2016
 * Time: 19.20
 */

namespace App\Http\Controllers\V1;

use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'username'  => 'required|min:3|unique:users',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:6',
        ]);

        $credentials = $request->only('username', 'email', 'password');

        $user = User::create($credentials);
        $role = Role::where('slug', 'member')->first();
        $user->roles()->attach($role);

        event(new UserRegistered($user));

        return [
            'status'    => 'success',
            'user'      => $user,
        ];
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'     => 'required|email',
            'password'  => 'required',
        ]);

        $user = User::where('email', $request->get('email'))->first();

        if ($user) {
            $hash_check = app('hash')->check($request->get('password'), $user->password);

            if ($hash_check)
                return [
                    'status'    => 'success',
                    'token'     => JWTAuth::fromUser($user),
                ];
            else
                return [
                    'status'    => 'failed',
                    'message'   => 'Credentials is not valid.',
                ];
        } else {
            return [
                'status'    => 'failed',
                'message'   => 'User not found.',
            ];
        }
    }
}
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
use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
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

        $credentials = $request->only('username', 'email');

        $user = User::create($credentials);
        $user->setPassword($request->get('password'));

        event(new UserRegistered($user));

        return [
            'status'    => 'success',
            'data'      => $user,
        ];
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'     => 'required|email|exists:users',
            'password'  => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        $user = User::where('email', $request->get('email'))->first();

        if ($user) {
            $hash_check = app('hash')->check($request->get('password'), $user->password);

            if ($hash_check)
                return JWTAuth::fromUser($user);
            else
                return [];
        } else {
            return ['tidak ditemukan'];
        }

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = app('auth')->attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));
    }
}
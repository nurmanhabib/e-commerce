<?php
/**
 * Created by PhpStorm.
 * User: bihama
 * Date: 21/02/2016
 * Time: 20.47
 */

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function emailOnly(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users'
        ]);
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'username'              => 'required|min:8|max:20|unique:users',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|min:10',

            'profile.first_name'    => 'required',
            'profile.last_name'     => 'required',
            'profile.gender'        => 'required',
            'profile.avatar'        => 'required',
        ]);

        $credentials    = $request->only('username', 'email', 'password');
        $profile        = $request->get('profile');
        $user           = $this->userRepository->register($credentials, $profile, $request->has('activated'));

        return [
            'status'            => 'success',
            'user'              => $user,
            'activation_code'   => $user->activation_code
        ];
    }
}
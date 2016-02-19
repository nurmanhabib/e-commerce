<?php
/**
 * Created by PhpStorm.
 * User: bihama
 * Date: 14/02/2016
 * Time: 19.20
 */

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'username'              => 'required|min:3|unique:users',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|min:6',

            'profile.first_name'    => 'required',
            'profile.last_name'     => 'required',
            'profile.gender'        => 'required',
            'profile.avatar'        => 'required',
        ]);

        $credentials    = $request->only('username', 'email', 'password');
        $profile        = $request->get('profile');
        $user           = $this->userRepository->register($credentials, $profile);

        return [
            'status'    => 'success',
            'user'      => $user,
        ];
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'password'  => 'required',
        ]);

        $credentials    = $request->all();
        $authenticate   = $this->userRepository->authenticate($credentials);

        return $authenticate;
    }
}
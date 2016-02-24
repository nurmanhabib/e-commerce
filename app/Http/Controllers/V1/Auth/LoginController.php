<?php
/**
 * Created by PhpStorm.
 * User: bihama
 * Date: 21/02/2016
 * Time: 10.09
 */

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Autentikasi dengan kombinasi username/email dan password
     *
     * @param Request $request
     * @return array
     */
    public function credentials(Request $request)
    {
        $this->validate($request, [
            'password'  => 'required',
        ]);

        $credentials    = $request->all();
        $authenticate   = $this->userRepository->authenticate($credentials);

        return $authenticate;
    }

    /**
     * Autentikasi dengan user id
     *
     * @param Request $request
     * @return array
     */
    public function id(Request $request)
    {
        $this->validate($request, [
            'id'  => 'required|numeric',
        ]);

        $authenticate = $this->userRepository->authenticateById($request->get('id'));

        if ($authenticate) {
            return [
                'status'    => 'success',
                'user'      => $authenticate['user'],
                'token'     => $authenticate['token'],
            ];
        } else {
            return [
                'status'    => 'failed',
                'message'   => 'User not found.',
            ];
        }
    }

    /**
     * Autentikasi dengan hashids
     * Digunakan untuk fitur remember me
     *
     * @param Request $request
     */
    public function hashids(Request $request)
    {
        $this->validate($request, [
            'hashids'   => 'required'
        ]);

    }

    /**
     * Permintaan refresh token
     *
     * @param Request $request
     * @return array
     */
    public function refreshToken(Request $request)
    {
        $this->middleware('auth');

        $user       = app('auth')->user();
        $newToken   = JWTAuth::parseToken()->refresh();

        return [
            'status'    => 'success',
            'user'      => $user,
            'token'     => $newToken,
        ];
    }
}
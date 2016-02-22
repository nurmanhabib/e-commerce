<?php
/**
 * Created by PhpStorm.
 * User: bihama
 * Date: 21/02/2016
 * Time: 10.08
 */

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create(Request $request)
    {
        if ($request->has('email')) {
            $column     = 'email';
            $identity   = $request->get('email');
        } elseif ($request->has('username')) {
            $column     = 'username';
            $identity   = $request->get('username');
        } else {
            return [
                'status'    => 'failed',
                'message'   => 'Credentials not found.'
            ];
        }

        $user   = $this->userRepository->findByField($column, $identity)->first();

        if ($user) {
            $this->userRepository->generateRememberToken($user);

            return [
                'status'            => 'success',
                'user'              => $user,
                'remember_token'    => $user->remember_token
            ];
        } else {
            return [
                'status'    => 'failed',
                'message'   => 'User not found'
            ];
        }
    }

    public function reset(Request $request)
    {
        $this->validate($request, [
            'email'             => 'required|email',
            'password'          => 'required|min:6|confirmed',
            'remember_token'    => 'required|size:100'
        ]);

        $user = $this->userRepository->resetPassword(
            $request->get('email'),
            $request->get('remember_token'),
            $request->get('password')
        );

        if ($user) {
            return [
                'status'    => 'success',
                'user'      => $user
            ];
        } else {
            return [
                'status'    => 'failed',
                'message'   => 'User not found or token not valid'
            ];
        }
    }
}
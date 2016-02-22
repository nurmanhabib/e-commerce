<?php
/**
 * Created by PhpStorm.
 * User: bihama
 * Date: 21/02/2016
 * Time: 10.03
 */

namespace App\Http\Controllers\V1\User;


use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function changePassword(Request $request)
    {
        $user = app('auth')->user();

        $this->validate($request, [
            'old_password'  => 'required|old_password:users,' . $user->id . ',password',
            'new_password'  => 'required|min:6|confirmed'
        ], [
            'old_password.old_password' => 'The old password does not match.'
        ]);

        $this->userRepository->setPassword($user, $request->get('new_password'));

        return [
            'status'    => 'success',
            'message'   => 'Password successfully changed'
        ];
    }

    public function show()
    {
        $user = app('auth')->user();

        return [
            'status'    => 'success',
            'user'      => $user
        ];
    }

    public function update(Request $request)
    {
        $user = app('auth')->user();

        if ($request->has('email')) {
            $user->email = $request->get('email');
            $user->save();
        }

        $user->profile()->update($request->get('profile'));

        return [
            'status'    => 'success',
            'user'      => $user->load('profile')
        ];
    }
}
<?php

namespace App\Http\Controllers\V1\User;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function show()
    {
        $user = app('auth')->user();

        return [
            'status'    => 'success',
            'user'      => $user
        ];
    }

    public function roles()
    {
        $user = app('auth')->user();

        return [
            'status'    => 'success',
            'roles'     => $user->roles
        ];
    }
}
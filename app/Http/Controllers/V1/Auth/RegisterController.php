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

    /**
     * Untuk login hanya berdasarkan email
     * 
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function emailOnly(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users'
        ]);

        $credentials    = [
            'username'      => null,
            'email'         => $request->get('email'),
            'password'      => null
        ];
        $profile        = [
            'first_name'    => null,
            'last_name'     => null,
            'gender'        => null,
            'avatar'        => null
        ];

        $user   = $this->userRepository->register($credentials, $profile, $request->has('activated'));

        return [
            'status'            => 'success',
            'user'              => $user,
            'activation_code'   => $user->activation_code
        ];

    }

    /**
     * Untuk melengkapi data dari register member berdasarkan email
     * 
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function completeRegistration(Request $request)
    {
        $this->validate($request, [
            'activation_code'       => 'required',
            'password'              => 'required|min:10',

            'profile.first_name'    => 'required',
            'profile.last_name'     => 'required',
            'profile.gender'        => 'required',
            'address.address_line_1'=> 'required',
            'address.phone'         => 'required'
        ]);

        $credentials    = $request->only('password', 'activation_code');
        $profile        = $request->get('profile');
        $address        = $request->get('address');
        $address['name']= 'home';
        $user           = $this->userRepository->completeRegistration($credentials, $address, $profile);

        return [
            'status'            => 'success',
            'user'              => $user,
            'activation_code'   => $user->activation_code
        ];
    }

    /**
     * Untuk melengkapi data dari register supplier berdasarkan email
     * 
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function completeRegistrationSupplier(Request $request)
    {
        $this->validate($request, [
            'activation_code'           => 'required',
            'password'                  => 'required|min:10',

            'profile.first_name'        => 'required',
            'profile.last_name'         => 'required',
            'profile.gender'            => 'required',

            'supplier.name'             => 'required',
            'supplier.address_line_1'   => 'required',
            'supplier.phone_1'          => 'required'
        ]);

        $credentials    = $request->only('password', 'activation_code');
        $profile        = $request->get('profile');
        $supplier       = $request->get('supplier');
        $user           = $this->userRepository->completeRegistrationSupplier($credentials, $supplier, $profile);

        return [
            'status'            => 'success',
            'user'              => $user,
            'activation_code'   => $user->activation_code
        ];
    }

    /**
     * Untuk register berdasarkan data lengkap
     * 
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|min:10',

            'profile.first_name'    => 'required',
            'profile.last_name'     => 'required',
            'profile.gender'        => 'required'
        ]);

        $credentials    = $request->only('email', 'password');
        $profile        = $request->get('profile');
        $user           = $this->userRepository->register($credentials, $profile, $request->has('activated'));

        return [
            'status'            => 'success',
            'user'              => $user,
            'activation_code'   => $user->activation_code
        ];
    }
}
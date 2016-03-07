<?php
/**
 * Created by PhpStorm.
 * User: bihama
 * Date: 17/02/2016
 * Time: 21.54
 */

namespace App\Repositories;

use App\Events\UserRegistered;
use App\Models\Role;
use App\Models\User;
use App\Models\Supplier;
use App\Models\ShippingAddress;
use Prettus\Repository\Criteria\RequestCriteria;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserRepository extends Repository
{
    protected $fieldSearchable = ['username', 'email'];

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    public function registerAndActivate(array $credentials, array $profile = [], $role = 'member')
    {
        $this->register($credentials, $profile, $role, true);
    }

    public function register(array $credentials, array $profile = [], $role = 'member', $activated = false)
    {
        if (array_key_exists('password', $credentials)) {
            $credentials['password'] = $this->createPassword($credentials['password']);
        }

        $user = $this->create($credentials);

        if (!$activated) {
            $this->generateActivationCode($user);
        }

        if (!empty($profile) && !$user->hasProfile()) {
            $user->profile()->create($profile);
        }

        $role = Role::where('slug', $role)->first();

        if ($role) {
            $user->roles()->attach($role);
        }

        return $user;
    }

    public function completeRegistration(array $credentials, array $address, array $profile = [], $role = 'member', $activated = true)
    {
        $credentials    = collect($credentials);
        $password       = $credentials->pull('password');
        $user           = $this->findWhere($credentials->toArray())->first();

        if ($user) {
            $user = $this->createShippingAddress($user, $address);

            $role = Role::where('slug', $role)->first();
            if ($role) {
                $user->roles()->attach($role);
            }

            $this->setProfile($user, $profile);

            $user->password         = $this->createPassword($password);
            $user->activation_code  = null;

            $user->save();

            return $user;    
        } else {
            return ['message' => 'User not found', 'activation_code' => 'activation code not found.'];
        }
    }

    public function completeRegistrationSupplier(array $credentials, array $supplier, array $profile = [], $role = 'supplier', $activated = true)
    {
        $credentials    = collect($credentials);
        $password       = $credentials->pull('password');
        $user           = $this->findWhere($credentials->toArray())->first();

        if ($user) {
            $role = Role::where('slug', $role)->first();
            if ($role) {
                $user->roles()->attach($role);
            }

            $this->setProfile($user, $profile);
            
            $this->createSupplier($user, $supplier);

            $user->password         = $this->createPassword($password);
            $user->activation_code  = null;

            $user->save();

            return $user;
        } else {
            return ['message' => 'User not found', 'activation_code' => 'Activation code not found.'];
        }
    }

    public function authenticate(array $credentials)
    {
        $credentials    = collect($credentials);
        $password       = $credentials->pull('password');
        $user           = $this->findWhere($credentials->toArray())->first();

        if ($user) {
            if (app('hash')->check($password, $user->password)) {
                return [
                    'status'    => 'success',
                    'user'      => $user,
                    'token'     => $this->getToken($user),
                ];
            }
        }

        return [
            'status'    => 'failed',
            'message'   => 'Credentials is not valid.'
        ];
    }

    public function authenticateById($id)
    {
        $user = $this->find($id);

        if ($user) {
            return [
                'user'  => $user,
                'token' => $this->getToken($user),
            ];
        } else {
            return null;
        }
    }

    public function getToken(User $user)
    {
        return JWTAuth::fromUser($user);
    }

    public function setProfile(User $user, array $profile)
    {
        if ($user->hasProfile()) {
            $user->profile()->update($profile);
        } else {
            $user->profile()->create($profile);
        }

        return $user;
    }

    public function generateActivationCode(User $user)
    {
        $activation_code = str_random(6);

        $user->forceFill(compact('activation_code'));
        $user->save();

        return $user->makeVisible('activation_code');
    }

    public function resetPassword($remember_token, $password)
    {
        $user = $this->findWhere(compact('remember_token'))->first();

        if ($user) {
            $this->setPassword($user, $password);

            $user->forceFill(['remember_token' => null]);
            $user->save();

            return $user;
        } else {
            return false;
        }
    }

    public function createPassword($plain)
    {
        return $this->makeModel()->createPassword($plain);
    }

    public function setPassword(User $user, $plain)
    {
        $user->forceFill([
            'password' => $this->createPassword($plain)
        ]);
        $user->save();

        return $user;
    }

    public function generateRememberToken(User $user)
    {
        $remember_token = str_random(100);

        $user->forceFill(compact('remember_token'));
        $user->save();

        return $user;
    }

    public function createShippingAddress(User $user, array $address)
    {
        $user->shippingAddress()->create($address);

        return $user->load('shippingAddress');
    }

    public function createSupplier(User $user, array $supplier)
    {
        $supplier = Supplier::create($supplier);
        $supplier->createSlug($supplier['name']);
        $supplier->users()->attach($user);
    }
}
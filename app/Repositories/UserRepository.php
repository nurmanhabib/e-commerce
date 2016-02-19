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

    public function register(array $credentials, array $profile = [], $role = 'member')
    {
        $user = $this->create($credentials);

        $this->generateActivationCode($user);

        if (!empty($profile) && !$user->hasProfile()) {
            $user->profile()->create($profile);
        }

        $role = Role::where('slug', $role)->first();

        if ($role) {
            $user->roles()->attach($role);
        }

        event(new UserRegistered($user));

        return $user->load('profile');
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
                    'user'      => $user->load('profile'),
                    'token'     => JWTAuth::fromUser($user),
                ];
            }
        }

        return [
            'status'    => 'failed',
            'message'   => 'Credentials is not valid.',
        ];
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

        return $user;
    }
}
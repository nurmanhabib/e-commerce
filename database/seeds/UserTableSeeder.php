<?php

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: Habib Nurrahman
 * Date: 15/02/2016
 * Time: 17.13
 */
class UserTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app('db')->table('users')->delete();
        app('db')->table('roles')->delete();
        app('db')->table('user_role')->delete();

        $roles = collect([
            'admin'     => 'Administrator',
            'member'    => 'Member',
            'supplier'  => 'Supplier'
        ]);

        $roles->transform(function ($name, $slug) {
            return Role::create(compact('name', 'slug'));
        });

        $users = collect([
            [
                'username'  => 'admin',
                'email'     => 'admin@amteklab.com',
                'password'  => 'password',
                'roles'     => ['admin'],
            ],
            [
                'username'  => 'member',
                'email'     => 'member@amteklab.com',
                'password'  => 'password',
                'roles'     => ['member'],
            ],
            [
                'username'  => 'supplier',
                'email'     => 'supplier@amteklab.com',
                'password'  => 'password',
                'roles'     => ['supplier'],
            ],
        ]);

        $users->transform(function ($user) {
            $user           = collect($user);
            $credentials    = $user->except('roles');
            $roles          = $user->only('roles');

            $credentials['password'] = app(User::class)->createPassword($credentials['password']);

            $roles->transform(function ($role) {
                return Role::where('slug', $role)->first()->id;
            });

            $user           = User::create($credentials->toArray());
            $user->roles()->attach($roles->toArray());
            $user->profile()->create([]);

            return $user;
        });
    }
}
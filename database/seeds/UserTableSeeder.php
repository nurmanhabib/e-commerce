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
        app('db')->table('user_role')->truncate();
        app('db')->table('users')->truncate();
        app('db')->table('roles')->truncate();

        $roles = collect([
            'admin'     => 'Administrator',
            'member'    => 'Member',
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
        ]);

        $users->transform(function ($user) {
            $user           = collect($user);
            $credentials    = $user->except('roles');
            $roles          = $user->only('roles');

            $roles->transform(function ($role) {
                return Role::where('slug', $role)->first()->id;
            });

            $user           = User::create($credentials->toArray());
            $user->roles()->attach($roles->toArray());
        });
    }
}
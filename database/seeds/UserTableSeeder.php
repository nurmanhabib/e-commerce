<?php

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
        app('db')->table('users')->truncate();
        app('db')->table('users')->insert([
            'username'  => 'admin',
            'email'     => 'admin@amteklab.com',
            'password'  => app('hash')->make('password'),
        ]);
    }
}
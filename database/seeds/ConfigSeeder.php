<?php

use Illuminate\Database\Seeder;
use App\Repositories\ConfigRepository;

class ConfigSeeder extends Seeder
{
    public function run()
    {
        app('db')->table('config')->truncate();

        $configs = [
            'name'                          => 'Amtekcommerce',
            'slogan'                        => 'Online Marketplace',
            'logo'                          => 'amc-contents/logo.jpg',

            'socialauth.facebook.api'       => ['value' => null, 'autoload' => false],
            'socialauth.facebook.token'     => ['value' => null, 'autoload' => false],
            'socialauth.facebook.secret'    => ['value' => null, 'autoload' => false],

            'socialauth.twitter.api'        => ['value' => null, 'autoload' => false],
            'socialauth.twitter.token'      => ['value' => null, 'autoload' => false],
            'socialauth.twitter.secret'     => ['value' => null, 'autoload' => false],

            'socialauth.google.api'         => ['value' => null, 'autoload' => false],
            'socialauth.google.token'       => ['value' => null, 'autoload' => false],
            'socialauth.google.secret'      => ['value' => null, 'autoload' => false],

            'socialauth.instagram.api'      => ['value' => null, 'autoload' => false],
            'socialauth.instagram.token'    => ['value' => null, 'autoload' => false],
            'socialauth.instagram.secret'   => ['value' => null, 'autoload' => false],
        ];

        $prefix     = 'amtekcommerce.';
        $results    = [];

        foreach ($configs as $key => $value) {
            $results[$prefix . $key] = $value;
        }

        app(ConfigRepository::class)->setForAll($results);
    }
}
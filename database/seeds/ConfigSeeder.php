<?php

use Illuminate\Database\Seeder;
use App\Repositories\ConfigRepository;

class ConfigSeeder extends Seeder
{
    public function run()
    {
        app('db')->table('config')->truncate();

        $configs = [
            'amtekcommerce.name'                            => 'Amtekcommerce',
            'amtekcommerce.slogan'                          => 'Online Marketplace',
            'amtekcommerce.logo'                            => 'amc-contents/logo.jpg',

            'amtekcommerce.socialauth.facebook.api'         => ['value' => null, 'autoload' => false],
            'amtekcommerce.socialauth.facebook.token'       => ['value' => null, 'autoload' => false],
            'amtekcommerce.socialauth.facebook.secret'      => ['value' => null, 'autoload' => false],

            'amtekcommerce.socialauth.twitter.api'          => ['value' => null, 'autoload' => false],
            'amtekcommerce.socialauth.twitter.token'        => ['value' => null, 'autoload' => false],
            'amtekcommerce.socialauth.twitter.secret'       => ['value' => null, 'autoload' => false],

            'amtekcommerce.socialauth.google.api'           => ['value' => null, 'autoload' => false],
            'amtekcommerce.socialauth.google.token'         => ['value' => null, 'autoload' => false],
            'amtekcommerce.socialauth.google.secret'        => ['value' => null, 'autoload' => false],

            'amtekcommerce.socialauth.instagram.api'        => ['value' => null, 'autoload' => false],
            'amtekcommerce.socialauth.instagram.token'      => ['value' => null, 'autoload' => false],
            'amtekcommerce.socialauth.instagram.secret'     => ['value' => null, 'autoload' => false],
        ];

        app(ConfigRepository::class)->setForAll($configs);
    }
}
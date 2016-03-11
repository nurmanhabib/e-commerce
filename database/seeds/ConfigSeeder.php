<?php

use Illuminate\Database\Seeder;
use App\Repositories\ConfigRepository;

class ConfigSeeder extends Seeder
{
    public function run()
    {
        app('db')->table('config')->truncate();

        $configs = [
            'name'                          => 'AmtekCommerce',
            'slogan'                        => 'Online Marketplace',
            'logo'                          => 'amc-contents/logo.jpg',

            'socialauth.facebook.link'      => ['value' => null, 'autoload' => true],
            'socialauth.facebook.api'       => ['value' => null, 'autoload' => false],
            'socialauth.facebook.token'     => ['value' => null, 'autoload' => false],
            'socialauth.facebook.secret'    => ['value' => null, 'autoload' => false],

            'socialauth.twitter.link'       => ['value' => null, 'autoload' => true],
            'socialauth.twitter.api'        => ['value' => null, 'autoload' => false],
            'socialauth.twitter.token'      => ['value' => null, 'autoload' => false],
            'socialauth.twitter.secret'     => ['value' => null, 'autoload' => false],

            'socialauth.google.link'        => ['value' => null, 'autoload' => true],
            'socialauth.google.api'         => ['value' => null, 'autoload' => false],
            'socialauth.google.token'       => ['value' => null, 'autoload' => false],
            'socialauth.google.secret'      => ['value' => null, 'autoload' => false],

            'socialauth.instagram.api'      => ['value' => null, 'autoload' => false],
            'socialauth.instagram.token'    => ['value' => null, 'autoload' => false],
            'socialauth.instagram.secret'   => ['value' => null, 'autoload' => false],

            'socialauth.line.api'           => ['value' => null, 'autoload' => false],
            'socialauth.line.token'         => ['value' => null, 'autoload' => false],
            'socialauth.line.secret'        => ['value' => null, 'autoload' => false],

            'auth.validation.username.min'  => 5,
            'auth.validation.username.max'  => 20,
            'auth.validation.password.min'  => 8,
            'auth.validation.password.max'  => null,

            'transaction.payment.due'       => 3 * 60, // dalam menit

            'sendmail.from.email'           => 'no-reply@amtekcommerce.com',
            'sendmail.from.name'            => 'AmtekCommerce',
        ];

        $prefix     = 'amtekcommerce.';
        $results    = [];

        foreach ($configs as $key => $value) {
            $results[$prefix . $key] = $value;
        }

        app(ConfigRepository::class)->setForAll($results);
    }
}
<?php

namespace App\Adapters\Factories;

class BuyerFactory
{
    public function make($driver, $email)
    {
        $method = 'driver' . ucwords($driver);

        return call_user_func_array([$this, $method], [$email]);
    }

    public function driverUser($email)
    {
        $user = \App\Models\User::where('email', $email)->first();

        if (!$user) {
            $user = \App\Models\User::create(compact('email'));
        }

        return $user;
    }

    public function driverGuest($email)
    {
        $guest = \App\Models\Guest::where('email', $email)->first();

        if (!$guest) {
            $guest = \App\Models\Guest::create(compact('email'));
        }

        return $guest;
    }
}
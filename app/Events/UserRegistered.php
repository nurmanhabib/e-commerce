<?php
/**
 * Created by PhpStorm.
 * User: ilma
 * Date: 15/02/2016
 * Time: 16.57
 */

namespace App\Events;

use App\User;

class UserRegistered extends Event
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
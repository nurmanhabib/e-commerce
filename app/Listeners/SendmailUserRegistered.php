<?php
/**
 * Created by PhpStorm.
 * User: ilma
 * Date: 15/02/2016
 * Time: 19.59
 */

namespace App\Listeners;


use App\Events\UserRegistered;

class SendmailUserRegistered
{
    public function __construct()
    {

    }

    public function handle(UserRegistered $event)
    {

    }
}
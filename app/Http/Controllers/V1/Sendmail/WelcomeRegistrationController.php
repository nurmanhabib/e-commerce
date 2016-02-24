<?php
/**
 * Created by PhpStorm.
 * User: ilma
 * Date: 22/02/2016
 * Time: 16.37
 */

namespace App\Http\Controllers\V1\Sendmail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WelcomeRegistrationController extends Controller
{
    public function send(Request $request)
    {
        $this->validate($request, [
            'user_id'   => 'required|exists:users'
        ]);


    }
}
<?php
/**
 * Created by PhpStorm.
 * User: bihama
 * Date: 14/02/2016
 * Time: 18.52
 */

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return [
            'status'    => 'success',
            'user'      => app('auth')->user(),
        ];
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'new_password'  => 'required|min:6',
            'old_password'  => 'required|old_password',
        ]);

        return $request->all();
    }
}
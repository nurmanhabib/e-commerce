<?php
/**
 * Created by PhpStorm.
 * User: bihama
 * Date: 14/02/2016
 * Time: 18.52
 */

namespace App\Http\Controllers\V1;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return [
            'status'    => 'success',
            'data'      => User::all(),
        ];
    }

    public function store(Request $request)
    {

    }
}
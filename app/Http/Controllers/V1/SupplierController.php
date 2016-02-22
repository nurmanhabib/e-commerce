<?php

namespace App\Http\Controllers\V1;

use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;


class SupplierController extends Controller
{
	public function index(Request $request)
	{
		$this->validate($request, [
            'name'     			=> 'required',
            'address_line_1'    => 'required',
            'phone_1'           => 'required|max:14',
            'phone_2'           => 'max:14',
            'email'             => 'required|email'
        ]);

        $credentials 	= $request->only(
            'slug',
        	'name', 
        	'address_line_1', 
        	'address_line_2',
        	'phone_1',
        	'phone_2',
        	'email',
        	'tags',
            'website'
        );

        $tenant = Supplier::create($credentials);

        return [
            'status'    => 'success',
            'user'      => $tenant,
        ]; 
	}
}
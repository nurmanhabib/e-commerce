<?php

namespace App\Http\Controllers\V1;

use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Supplier;
use App\Models\Product;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;


class SupplierController extends Controller
{
    public function index()
    {
        return [
            'status'    => 'success',
            'suppliers' => Supplier::all(),
        ];
    }

	public function store(Request $request)
	{
		$this->validate($request, [
            'name'     			=> 'required',
            'address_line_1'    => 'required',
            'phone_1'           => 'required|max:14',
            'phone_2'           => 'max:14',
            'email'             => 'required|email'
        ]);

        $credentials 	= $request->only(
        	'name', 
        	'address_line_1', 
        	'address_line_2',
        	'phone_1',
        	'phone_2',
        	'email',
        	'tags',
            'website'
        );

        $user       = app('auth')->user();
        $supplier   = Supplier::create($credentials);
        $supplier->createSlug($request->input('name'));
        $supplier->users()->attach($user);

        if ($supplier) {
            return [
                'status'    => 'success',
                'user'      => $supplier,
            ];  
        } else {
            return [
                'status'    => 'failed',
                'user'      => 'Create supplier data was failed.',
            ];
        }
	}

    public function show($id)
    {
        $supplier   = Supplier::find($id);

        if ($supplier) {
            return [
                'status'    => 'success',
                'supplier'  => $supplier
            ];
        } else {
            return [
                'status'    => 'failed',
                'supplier'  => 'Supplier data not found.'
            ];
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'              => 'required',
            'address_line_1'    => 'required',
            'phone_1'           => 'required|max:14',
            'phone_2'           => 'max:14',
            'email'             => 'required|email'
        ]);

        $supplier   = Supplier::find($id);

        if ($supplier) {
            $supplier->slug             = $request->input('slug');
            $supplier->name             = $request->input('name');
            $supplier->address_line_1   = $request->input('address_line_1');
            $supplier->address_line_2   = $request->input('address_line_2');
            $supplier->phone_1          = $request->input('phone_1');
            $supplier->phone_2          = $request->input('phone_2');
            $supplier->email            = $request->input('email');
            $supplier->tags             = $request->input('tags');
            $supplier->website          = $request->input('website');

            if ($supplier->save()) {
                return [
                    'status'    => 'success',
                    'message'   => 'Supplier data successfully updated.',
                    'supplier'  => $supplier
                ];
            } else {
                return [
                    'status'    => 'failed',
                    'message'   => 'Supplier data failed to update.'
                ];
            }
        } else {
            return [
                'status'    => 'failed',
                'message'   => 'Supplier data not found.'
            ];
        }
    }

    public function destroy($id)
    {
        $supplier   = Supplier::find($id);

        if ($supplier) {
            
            $deleteProduct  = Product::where('supplier_id', '=', $id)->delete();

            if ($supplier->delete()) {
                return [
                    'status'    => 'success',
                    'message'   => 'Supplier data successfully deleted.'
                ];
            } else {
                return [
                    'status'    => 'failed',
                    'message'   => 'Supplier data failed to deleted.'
                ];
            }
        } else {
            return [
                'status'    => 'failed',
                'message'   => 'Supplier data not found.'
            ];
        }
    }
}
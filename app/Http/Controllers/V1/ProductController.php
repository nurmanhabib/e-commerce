<?php 

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Supplier;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
	public function index()
    {
        return [
            'status'    => 'success',
            'products'  => Product::all(),
        ];
    }

	public function store(Request $request)
	{
		$this->validate($request, [
			'code'			=> 'required',	
            'name'     		=> 'required',
            'description' 	=> 'required',
            'price'         => 'required',
            'category_id'   => 'required'
        ]);

        $credentials 	= $request->only(
        	'code',
        	'name',
        	'description',
        	'price',
        	'category_id',
        	'supplier_id'
        );

        $product 	= Product::create($credentials);

        if($product){
        	return [
        		'status' 	=> 'success',
        		'message' 	=> 'Product has successfully added.',
        		'product' 	=> $product
        	];
        }else{
        	return [
        		'status' 	=> 'failed',
        		'message' 	=> 'Product has failed to be added.'
        	];
        }
	}

	public function show($id)
	{
		$product 	= Product::find($id);

		if($product){
			return [
				'status' 	=> 'success',
				'product' 	=> $product
			];
		}else{
			return [
				'status'	=> 'failed',
				'message' 	=> 'Product not found.'
			];
		}
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'code'			=> 'required',	
            'name'     		=> 'required',
            'description' 	=> 'required',
            'price'         => 'required',
            'category_id'   => 'required'
        ]);

		$product 	= Product::find($id);

		if($product){
			$product->code 			= $request->input('code');
			$product->name 			= $request->input('name');
			$product->description 	= $request->input('description');
			$product->price 		= $request->input('price');
			$product->category_id 	= $request->input('category_id');
			$product->supplier_id 	= $request->input('supplier_id');

			if($product->save()){
				return [
					'status' 	=> 'success',
					'message' 	=> 'Product has been updated.',
					'product' 	=> $product
				];
			}else{
				return [
					'status' 	=> 'success',
					'message' 	=> 'Product has failed to be update.'
				];
			}
		}else{
			return [
				'status' 	=> 'failed',
				'message'  	=> 'Product not found.'
			];
		}
	}

	public function destroy($id)
	{
		$product 	= Product::find($id);

		if($product){
			if($product->delete()){
				return [
					'status' 	=> 'success',
					'message' 	=> 'Product has successfully deleted.'
				];
			}else{
				return [
					'status' 	=> 'failed',
					'message' 	=> 'Product has failed to be delete.'
				];
			}
		}else{
			return [
				'status' 	=> 'failed',
				'message' 	=> 'Product not found.'
			];
		}
	}
}
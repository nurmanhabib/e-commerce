<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\Supplier;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function show($supplier_slug, $id)
    {
    	$supplier = Supplier::whereSlug($supplier_slug)->first();
    	$product = $supplier->products()->find($id);

        return view('front.product.show', compact('product'));
    }
}
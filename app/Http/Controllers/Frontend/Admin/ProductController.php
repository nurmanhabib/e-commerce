<?php

namespace App\Http\Controllers\Frontend\Admin;

use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
    	return view('admin.product.index');
    }
}
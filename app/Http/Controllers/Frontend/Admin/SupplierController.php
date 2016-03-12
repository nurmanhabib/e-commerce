<?php

namespace App\Http\Controllers\Frontend\Admin;

use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    public function index()
    {
    	return view('admin.supplier.index');
    }
}
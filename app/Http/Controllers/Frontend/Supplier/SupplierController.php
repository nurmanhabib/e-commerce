<?php

namespace App\Http\Controllers\Frontend\Supplier;

use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    public function index()
    {
        return view('supplier.products.products');
    }
}
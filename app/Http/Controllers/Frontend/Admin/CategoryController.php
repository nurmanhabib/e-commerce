<?php

namespace App\Http\Controllers\Frontend\Admin;

use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
	public function index()
    {
        return view('admin.category.category');
    }
}
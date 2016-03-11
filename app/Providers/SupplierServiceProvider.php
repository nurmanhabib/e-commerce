<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class SupplierServiceProvider extends ServiceProvider
{
	public function boot()
	{
        if ($user = Auth::user()) {
        	$supplier = $user->supplier;

            app()->singleton(Supplierable::class, $supplier->first());
        }
	}

	public function register()
	{

	}
}
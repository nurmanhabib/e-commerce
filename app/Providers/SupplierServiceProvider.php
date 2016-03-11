<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use App\Supports\Contracts\Supplierable;

class SupplierServiceProvider extends ServiceProvider
{
	public function boot()
	{
        if ($user = Auth::user()) {
        	$supplier = $user->supplier;

            app()->instance(Supplierable::class, $supplier->first());
        }
	}

	public function register()
	{

	}
}
<?php

namespace App\Repositories;

use App\Events\UserRegistered;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;
use App\Models\Supplier;
use Prettus\Repository\Criteria\RequestCriteria;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProductRepository extends Repository
{
	public function model()
    {
        return Product::class;
    }

    public function getProductBySupplier(Supplier $supplier)
    {
    	$products = $this->findWhereIn('supplier_id', $supplier->id);

    	return $products;
    }

	public function getProductsById(array $products)
	{
		$products = $this->findWhereIn('id', $products);

		return $products;
	}

	public function destroyProducts(array $products)
	{

	}

	public function saveTags(Product $product, array $tags)
	{
		$results = [];

		foreach ($tags as $tag) {
			$tag 	= trim($tag);
			$find	= Tag::where('name', $tag)->first();

			if (!$find) {
				$find	= Tag::create(['name' => $tag]);
			}

			$results[]	= $find;
		}

		$product_ids	= collect($results)->pluck('id');

		$product->tags()->attach($product_ids->toArray());

		return $results;
	}
}
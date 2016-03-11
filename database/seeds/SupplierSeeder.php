<?php

use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run()
    {
        DB::table('suppliers')->delete();
        DB::table('categories')->delete();

        $categories = [
            [
                'slug'      => 'otomotif',
                'name'      => 'Otomotif',
            ],

            [
                'slug'      => 't-shirt',
                'name'      => 'T-Shirt',
                'childs'    => [                    
                    [
                        'slug'      => 'woman',
                        'name'      => 'Woman',
                    ],                    
                    [
                        'slug'      => 'man',
                        'name'      => 'Man',
                    ],
                ]
            ],

            [
                'slug'      => 'electronic',
                'name'      => 'Electronic',
                'childs'    => [                 
                    [
                        'slug'      => 'laptop',
                        'name'      => 'Laptop',
                    ],                    
                    [
                        'slug'      => 'handphone',
                        'name'      => 'Handphone',
                    ],
                ]
            ],
        ];

        $categories = collect($categories)->map(function ($cat) {
            $category = App\Models\Category::create([
                'slug'  => $cat['slug'],
                'name'  => $cat['name'],
            ]);

            if (array_key_exists('childs', $cat)) {
                foreach ($cat['childs'] as $cate) {
                    App\Models\Category::create([
                        'slug'      => $cat['slug'],
                        'name'      => $cat['name'],
                        'parent_id' => $category->id
                    ]);
                }
            }

            return $category;
        });

        $users = App\Models\User::all();

        $users->each(function ($user) use ($categories) {
            $suppliers = factory(App\Models\Supplier::class, 10)->create();

            $suppliers->each(function ($supplier) use ($categories, $user) {
                $supplier->users()->attach($user);

                $cat_ids    = $categories->pluck('id');
                $cat_pick   = $cat_ids->random();

                factory(App\Models\Product::class, 15)->create([
                    'supplier_id'   => $supplier->id,
                    'category_id'   => $cat_pick,
                ]);
            });
        });
    }
}
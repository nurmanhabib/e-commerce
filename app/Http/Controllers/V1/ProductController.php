<?php 

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Supplier;
use App\Models\UserSupplier;
use App\Repositories\ProductRepository;
use App\Models\Product;
use App\Supports\Contracts\Supplierable;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Untuk menampilkan semua data product
     * 
     * @return [type] [description]
     */
    public function index()
    {
        return [
            'status'    => 'success',
            'products'  => Product::orderBy('id', 'desc')->get(),
        ];
    }

    /**
     * Untuk menyimpan data product
     * 
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request, Supplierable $supplier)
    {
        $this->validate($request, [
            'code'          => 'required',  
            'name'          => 'required',
            'description'   => 'required',
            'price'         => 'required',
            'category_id'   => 'required'
        ]);

        $data = $request->only(
            'code',
            'name',
            'description',
            'price',
            'category_id'
        );

        if (is_string($request->get('tags'))) {
            $tags = explode(',', $request->get('tags'));
        } else {
            $tags = $request->get('tags', []);
        }

        $product = new Product;
        $product->fill($data);
        $product->supplier()->associate($supplier);
        $product->save();

        $this->productRepository->saveTags($product, $tags);

        if ($product) {
            return [
                'status'    => 'success',
                'message'   => 'Product has successfully added.',
                'product'   => $product
            ];
        } else {
            return [
                'status'    => 'failed',
                'message'   => 'Product has failed to be added.'
            ];
        }
    }

    /**
     * Untuk menampilkan product berdasarkan id
     * 
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function show($id)
    {
        $product    = Product::find($id);

        if($product){
            return [
                'status'    => 'success',
                'product'   => $product
            ];
        }else{
            return [
                'status'    => 'failed',
                'message'   => 'Product not found.'
            ];
        }
    }

    /**
     * Untuk update data product
     * 
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'code'          => 'required',  
            'name'          => 'required',
            'description'   => 'required',
            'price'         => 'required',
            'category_id'   => 'required'
        ]);

        $product    = Product::find($id);

        if($product){
            $product->code          = $request->input('code');
            $product->name          = $request->input('name');
            $product->description   = $request->input('description');
            $product->price         = $request->input('price');
            $product->tags          = $request->input('tags');
            $product->category_id   = $request->input('category_id');

            if($product->save()){
                return [
                    'status'    => 'success',
                    'message'   => 'Product has been updated.',
                    'product'   => $product
                ];
            }else{
                return [
                    'status'    => 'success',
                    'message'   => 'Product has failed to be update.'
                ];
            }
        }else{d
            return [
                'status'    => 'failed',
                'message'   => 'Product not found.'
            ];
        }
    }

    /**
     * Untuk menghapus data product
     * 
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function destroy($id)
    {
        $product    = Product::find($id);

        if($product){
            if($product->delete()){
                return [
                    'status'    => 'success',
                    'message'   => 'Product has successfully deleted.'
                ];
            }else{
                return [
                    'status'    => 'failed',
                    'message'   => 'Product has failed to be delete.'
                ];
            }
        }else{
            return [
                'status'    => 'failed',
                'message'   => 'Product not found.'
            ];
        }
    }
}
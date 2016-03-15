<?php 

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class ProductImageController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'product_id'    => 'required|exists:products,id',
            'base64_image'  => 'require'
        ]);

        $product_id     = $request->get('product_id');
        $product        = Product::find($product_id);
        $supplier       = $product->supplier;

        $base64_image   = $request->file('base64_image');

        $manager        = new ImageManager;
        $image          = $manager->make($base64_image);

        $config         = config('amtekcommerce.product_image');
        $filename       = date('YmdHis', time()) . '.jpg';
        $upload_dir     = $config['dir'] . '/sup_' . $supplier->id;
        $upload_file    = $upload_dir . '/' . $filename;

        if (is_dir($upload_dir) === false) {
            mkdir($upload_dir);
        }

        $resize['w']    = $config['resize'][0];
        $resize['h']    = $config['resize'][1];

        $image->resize($resize['w'], $resize['h']);
        $image->save($upload_file);

        $filesize   = $image->filesize();
        $filetype   = $image->mime();

        $image_product = ProductImage::create(compact('filename', 'filetype', 'filesize', 'product_id'));

        return $image_product;
    }
}
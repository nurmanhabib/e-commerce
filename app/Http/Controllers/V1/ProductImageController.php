<?php 

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class ProductImageController extends Controller
{
    /**
     * Fungsi untuk menampilkan semua gambar produk
     * @return [type] [description]
     */
    public function index()
    {
        $product_images = ProductImage::all();

        return [
            'status'            => 'success',
            'product_images'    => $product_images
        ];
    }

    /**
     * Fungsi untuk menyimpan gambar produk
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'product_id'    => 'required|exists:products,id',
            'base64_image'  => 'required'
        ]);

        $product_id     = $request->get('product_id');

        $base64_image   = $request->file('base64_image');

        $image_product  = $this->saveImage($product_id, $base64_image);

        $image_product = ProductImage::create($image_product);

        return $image_product;
    }

    /**
     * Fungsi untuk menampilkan gambar produk berdasarkan id gambar
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function show($id)
    {
        $product_image  = ProductImage::find($id);

        if ($product_image) {
            return [
                'status'        => 'success',
                'message'       => 'Gambar produk tersedia.',
                'product_image' => $product_image
            ];
        } else {
            return [
                'status'        => 'failed',
                'message'       => 'Gambar produk tidak tersedia.',
                'product_image' => null
            ];
        }
    }

    /**
     * Fungsi untuk menampilkan seluruh gambar berdasarkan id produk
     * @param  [type] $product_id [description]
     * @return [type]             [description]
     */
    public function showProductImages($product_id)
    {
        $product_images     = ProductImage::where('product_id', $product_id)->get();

        if ($product_images) {
            return [
                'status'            => 'success',
                'message'           => 'Gambar produk tersedia.',
                'product_images'    => $product_images
            ];
        } else {
            return [
                'status'            => 'failed',
                'message'           => 'Gambar produk tidak tersedia.',
                'product_images'    =>  null
            ];
        }
    }

    /**
     * Fungsi untuk menyimpan pembaruan data gambar
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'product_id'    => 'required|exists:products,id',
            'base64_image'  => 'required'
        ]);

        $product_image  = ProductImage::find($id);

        if ($product_image) {
            $product_id     = $request->get('product_id');
            $base64_image   = $request->file('base64_image');
            $image_product  = $this->saveImage($product_id, $base64_image);

            $product        = Product::find($product_id);
            $supplier       = $product->supplier;
            $config         = config('amtekcommerce.product_image');
            $upload_dir     = $config['dir'] . '/sup_' . $supplier->id;
            $deleteImage    = unlink($upload_dir.'/'.$product_image->name);

            if ($deleteImage) {
                $image_product  = $this->saveImage($product_id, $base64_image);

                $product_image->name        = $image_product['name'];
                $product_image->filetype    = $image_product['filetype'];
                $product_image->filesize    = $image_product['filesize'];
                $product_image->product_id  = $product_id;

                if ($product_image->save()) {
                    return [
                        'status'        => 'success',
                        'message'       => 'Gambar produk berhasil diperbarui.',
                        'product_image' => $product_image
                    ];
                } else {
                    return [
                        'status'        => 'failed',
                        'message'       => 'Gambar produk tidak berhasil diperbarui.',
                        'product_image' => $product_image
                    ];
                }

            } else {
                return [
                    'status'        => 'failed',
                    'message'       => 'Gambar produk tidak berhasil diperbarui.',
                    'product_image' => $product_image
                ];
            }

        } else {
            return [
                'status'        => 'failed',
                'message'       => 'Gambar produk tidak tersedia.',
                'product_image' => null
            ];
        }
    }

    /**
     * Fungsi untuk menghapus gambar produk
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function destroy($id)
    {
        $product_image  = ProductImage::find($id);

        if ($product_image) {
            $product        = Product::find($product_image->product_id);
            $supplier       = $product->supplier;
            $config         = config('amtekcommerce.product_image');
            $upload_dir     = $config['dir'] . '/sup_' . $supplier->id;
            $deleteImage    = unlink($upload_dir.'/'.$product_image->name);

            if ($deleteImage) {
                
                if ($product_image->delete()) {
                    return [
                        'status'    => 'success',
                        'message'   => 'Gambar produk berhasil dihapus.'
                    ];
                } else {
                    return [
                        'status'    => 'failed',
                        'message'   => 'Data Gambar tidak berhasil dihapus.'
                    ];
                }

            } else {
                return [
                    'status'        => 'failed',
                    'message'       => 'Gambar produk tidak berhasil dihapus.'
                ];
            }

        } else {
            return [
                'status'    => 'failed',
                'message'   => 'Gambar produk tidak tersedia.'
            ];
        }
    }

    /**
     * Fungsi untuk menghapus gambar produk berdasarkan id produknya
     * @param  [type] $product_id [description]
     * @return [type]             [description]
     */
    public function destroyByProduct($product_id)
    {
        $product_images     = ProductImage::where('product_id', $product_id)->get();

        if ($product_images) {
            $config         = config('amtekcommerce.product_image');

            foreach ($product_images as $product_image) {
                $product        = Product::find($product_image->product_id);
                $supplier       = $product->supplier;
                $upload_dir     = $config['dir'] . '/sup_' . $supplier->id;
                $deleteImage    = unlink($upload_dir.'/'.$product_image->name);

                if ($deleteImage) {
                    $product_image->delete();
                }
            }

            $check_product_images   = ProductImage::where('product_id', $product_id)->get();

            if (count($check_product_images) > 0) {
                return [
                    'status'            => 'failed',
                    'message'           => 'Tidak semua gambar produk berhasil dihapus.',
                    'product_images'    =>  $check_product_images
                ];
            } else {
                return [
                    'status'            => 'success',
                    'message'           => 'Gambar produk berhasil dihapus.',
                    'product_images'    => null
                ];
            }

        } else {
            return [
                'status'    => 'failed',
                'message'   => 'Gambar produk tidak tersedia.',
                'product_images'    => null
            ];
        }
    }

    /**
     * Fungsi untuk menyimpan file gambar
     * @param  [type] $product_id   [description]
     * @param  [type] $base64_image [description]
     * @return [type]               [description]
     */
    private function saveImage($product_id, $base64_image)
    {
        $product        = Product::find($product_id);
        $supplier       = $product->supplier;

        $manager        = new ImageManager;
        $image          = $manager->make($base64_image);

        $config         = config('amtekcommerce.product_image');

        $supplierCode   = $supplier->code;
        $productCode    = $product->code;
        $fileType       = $base64_image->guessExtension();
        $filename       = $supplierCode . '_' . $productCode . '_' . date('YmdHis', time()) . '.' . $fileType;

        $upload_dir     = $config['dir'] . '/sup_' . $supplier->id;
        $upload_file    = $upload_dir . '/' . $filename;

        if (is_dir($upload_dir) === false) {
            mkdir($upload_dir);
        }

        $resize['w']    = $config['resize'][0];
        $resize['h']    = $config['resize'][1];

        $image->resize($resize['w'], $resize['h']);
        $image->save($upload_file);

        $filesize       = $image->filesize();
        $fileMimeType   = $image->mime();

        $image_product = [
            'name'          => $filename,
            'filetype'      => $fileType,
            'filesize'      => $filesize,
            'product_id'    => $product_id
        ];

        return $image_product;
    }
}
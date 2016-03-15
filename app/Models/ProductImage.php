<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManager;

class ProductImage extends Model
{
    public function filepath()
    {
        $location   = __DIR__.'/../../storage/app/product_images/';
        $subforlder = 'supplier_' . $this->supplier->code . '/';
        $filename   = $this->filename;

        return $location . $subforlder . $filename;
    }
}
<?php

namespace App\Http\Controllers;

use Dingo\Api\Exception\StoreResourceFailedException;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected function throwValidationException(Request $request, $validator)
    {
        throw new StoreResourceFailedException('The given data failed to pass validation.', $this->formatValidationErrors($validator));
    }
}

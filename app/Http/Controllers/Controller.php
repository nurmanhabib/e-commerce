<?php

namespace App\Http\Controllers;

use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use Helpers;

    protected function throwValidationException(Request $request, $validator)
    {
        throw new StoreResourceFailedException('The given data failed to pass validation.', $this->formatValidationErrors($validator));
    }
}

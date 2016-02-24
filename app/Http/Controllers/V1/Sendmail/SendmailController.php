<?php
/**
 * Created by PhpStorm.
 * User: ilma
 * Date: 22/02/2016
 * Time: 16.30
 */

namespace App\Http\Controllers\V1\Sendmail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SendmailController extends Controller
{
    public function send(Request $request)
    {
        $this->validate($request, [
            'to.email'  => 'required',
            'to.name'   => 'required|string',
            'subject'   => 'required',
            'body'      => 'required',
        ]);
    }
}
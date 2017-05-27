<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Captcha;
use Log;

class CaptchaController extends Controller
{
    public function create(Request $request)
    {
        $resp= Captcha::create();
        return $resp;
    }
}

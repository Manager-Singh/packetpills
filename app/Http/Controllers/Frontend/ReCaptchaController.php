<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/**
 * Class ReCaptchaController.
 */
class ReCaptchaController extends Controller
{
    public function verify(Request $request)
    {
        dd('hhshs');
        dd(GoogleReCaptchaV2::verifyResponse($request->input('g-recaptcha-response'))->getMessage());
    }
    public function index(Request $request)
    {
        return view('index');    
   }
}
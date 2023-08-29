<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
       
        return view('frontend.index');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function mainIndex()
    {
        
        
        return view('frontend.main-index');
    }
}

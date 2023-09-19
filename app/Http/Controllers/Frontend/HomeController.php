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
        
      if(Auth::check() && Auth::user()->is_profile_status == 'pending'){
                return redirect()->route('frontend.auth.step.personal');
      }  
        return view('frontend.main-index');
    }
}

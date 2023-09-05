<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //return '<h2>You are logedin successfully!</h2>';
        return view('frontend.user.dashboard');
    }

    public function serviceSelection(){
        //return '<h2>You are logedin successfully!</h2>';
        return view('frontend.auth.steps.service-selection');
    }

    public function stepTransfer(){
        return view('frontend.auth.steps.transfer');
    }
    public function prescription(){
        return view('frontend.auth.steps.prescription');
    }
    public function telehealth(){
        return view('frontend.auth.steps.telehealth');
    }
    public function personal(){
        return view('frontend.auth.steps.personal');
    }
    public function almostdone(){
        return view('frontend.auth.steps.almostdone');
    }
    public function createPassword(){
        return view('frontend.auth.steps.create-password');
    }
    public function profileCompleted(){
        return view('frontend.auth.steps.profile-completed');
    }
}

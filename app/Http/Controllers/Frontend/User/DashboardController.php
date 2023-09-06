<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Auth\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{

    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;

    }
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


    public function personal_save(Request $request){



        $output = $this->userRepository->update(
            Auth::user(),
            ['first_name'=>$request->first_name, 'last_name'=>$request->first_name, 'date_of_birth'=>$request->date.'-'.$request->month.'-'.$request->year,'profile_step'=>1],
            $request->has('avatar_location') ? $request->file('avatar_location') : false
        );

        if($output){
            return redirect()->route('frontend.auth.step.almostdone')->withFlashSuccess(__('Information Updated'));
        }else{
            return redirect()->back()->withFlashInfo(__('Something went wrong'));
        }

    }
    public function almostdone(){
        return view('frontend.auth.steps.almostdone');
    }
    public function almostdone_save(Request $request){


        // 'province'=>$request->province,
        $output = $this->userRepository->update(
            Auth::user(),
            ['gender'=>$request->gender, 'email'=>$request->email, 'province'=>$request->province,'profile_step'=>2],
            $request->has('avatar_location') ? $request->file('avatar_location') : false
        );

        if($output){
            return redirect()->route('frontend.auth.step.create.password')->withFlashSuccess(__('Information Updated'));
        }else{
            return redirect()->back()->withFlashInfo(__('Something went wrong'));
        }

    }
    public function createPassword(){
        return view('frontend.auth.steps.create-password');
    }

    public function createPassword_save(Request $request){

        //dd($request->all());
        // 'province'=>$request->province,
        $output = $this->userRepository->update(
            Auth::user(),
            ['password'=>$request->password,'profile_step'=>3],
            $request->has('avatar_location') ? $request->file('avatar_location') : false
        );

        if($output){
            return redirect()->route('frontend.auth.step.profile.completed')->withFlashSuccess(__('Information Updated'));
        }else{
            return redirect()->back()->withFlashInfo(__('Something went wrong'));
        }

    }


    public function profileCompleted(){
        return view('frontend.auth.steps.profile-completed');
    }
}

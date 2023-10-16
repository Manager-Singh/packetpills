<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB; 
use Mail; 
use Carbon\Carbon; 
/**
 * Class ForgotPasswordController.
 */
class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        //return view('frontend.auth.passwords.email');
        return view('frontend.auth.passwords.phone-email');
    }

    public function sendResetLinkPhone(Request $request){
       
       // dd($request->all());
        $request->validate([
             'mobile_no' => 'required|exists:users',
            ]);
            print_r($request->all());
            dd('fff');
            $token = Str::random(64);
            try {
            // DB::table('password_resets')->insert([

            // 'email' => $request->mobile_no, 

            // 'token' => $token, 

            // 'created_at' => Carbon::now()

            // ]);
            notify()->success('Password reset Link sent successfully!');
            return back()->with('message', 'We have e-mailed your password reset link!');
        }catch (\Exception $e) {
            // something went wrong
           // dd($e);
            DB::rollback();
            notify()->error($e->getMessage());
            return response()->json(['status'=>0,'message'=>$e->getMessage()]);

        }
    }
}

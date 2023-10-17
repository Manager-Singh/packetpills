<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB; 
use Mail; 
use Carbon\Carbon;  
use App\Models\PasswordResetsOtp;
use App\Models\Auth\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

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
       $type = '';
       if (is_numeric($request->input('mobile_no'))){
        
            $request->validate([
                'mobile_no' => 'required|exists:users,mobile_no',
            ]);
            $type = 'mobile';  
            $mobile_email = $request->mobile_no;
            $user = User::where('mobile_no',$request->mobile_no)->first();
       }else{
        
            $request->validate([
                'mobile_no'=>'required|email|exists:users,email',
                
            ], [
                'mobile_no.required' => 'The Email Required.',
                'mobile_no.email' => 'The selected email is invalid.',
                'mobile_no.exists' => 'You are not registered with this email.',
            ]);

            $type = 'email';
            $mobile_email = $request->mobile_no;
            $user = User::where('email',$request->mobile_no)->first();
            
       }
       $otp = generateOTP();
       try {

            if($user->mobile_no && $user->dialing_code){
                $mobile = $user->dialing_code.$user->mobile_no;
                if(sendMessage($mobile,'mail','forgot_reset_otp',$otp)){
                    if($passwordResetsOtp = PasswordResetsOtp::where('mobile_email',$request->mobile_no)->first()){
                        $password_resets_otp  = $passwordResetsOtp;
                    }else{
                        $password_resets_otp  = new PasswordResetsOtp();
                    }
                    
                    $password_resets_otp->mobile_email = $request->mobile_no; 
                    $password_resets_otp->otp = $otp; 
                    if($password_resets_otp->save()){
                        return view('frontend.auth.passwords.phone-email',compact('user','mobile_email'));
                    }
                }
            }
            
            
            return back()->with('message', 'We have e-mailed your password reset link!');
        }catch (\Exception $e) {
            // something went wrong
           // dd($e);
            DB::rollback();
            
            return response()->json(['status'=>0,'message'=>$e->getMessage()]);

        }
    }

    public function phoneOtpVerfiy(Request $request){
       // dd($request->all());

        $user = User::where('mobile_no',$request->mobile_no)->first();
        if($user ){
            $user_otp = PasswordResetsOtp::where('mobile_email',$request->mobile_no)->where('otp',$request->otp)->first();
            $mobile_email = $request->mobile_no;
            if($user_otp){
                $user_otp->status = 'verified';
                if($user_otp->save()){
                    //Auth::loginUsingId($user->id);
                    return view('frontend.auth.passwords.password-update',compact('user','mobile_email'));
                }
            }else{
                return redirect()->back()->withFlashSuccess(__('Something went wrong.'));
                //password.update
            }
        }

    }
    public function updatePassword(){
        
        return view('frontend.auth.passwords.password-update');

    }

    public function updateSavePassword(Request $request){
        $request->validate([
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password|min:6'
        ]);
        
        if(PasswordResetsOtp::where('mobile_email',$request->mobile_no)->first()){
            return redirect()->back()->withFlashSuccess(__('OTP does not match please try again.'));
        }

        $user = User::where('mobile_no',$request->mobile_no)->first();
        $user->password = Hash::make($request->password);
        // if($user->save()){
        //     return redirect()->route('dashboard')->with('success', 'Password updated successfully.');

        // }
        if($user->save()){
            PasswordResetsOtp::where('mobile_email',$request->mobile_no)->delete();
            return redirect()->route('frontend.auth.new.login')->withFlashSuccess(__('Password updated successfully.'));
        }else{
            return redirect()->back()->withFlashInfo(__('Something went wrong'));
        }
       

    }
}

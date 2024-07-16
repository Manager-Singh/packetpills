<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Events\Frontend\Auth\UserLoggedIn;
use App\Events\Frontend\Auth\UserLoggedOut;
use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;
use Illuminate\Support\Facades\Auth;
use App\Models\Auth\User;
use App\Models\UserOtp;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Exception;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Session;
use App\Rules\ReCaptcha;
use GuzzleHttp\Client as Gclient; 
use App\Models\Prescription;
/**
 * Class LoginController.
 */
class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @return string
     */
    public function redirectPath()
    {
        return route(home_route());
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
       
       // return view('frontend.auth.login');
        return view('frontend.auth.new-login'); 
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showNewLoginForm()
    {
    //     $otp = generateOTP();
    //     $accountSid = config('app.twilio')['TWILIO_ACCOUNT_SID'];
    //     $authToken = config('app.twilio')['TWILIO_AUTH_TOKEN'];
    //     try{
            
            
    //         $client = new Client($accountSid, $authToken);
    //        $message = $client->messages->create('4168170858', [
    //             'from' => +16475034144,
    //             'body' => 'CODE: '. $otp]);

    //          dd($message);
    //     }
    //     catch (Exception $e){

    //         dd($e);
    //         return json_encode(['error' => 1, 'message' => $e]);
    //   //  echo "Error: " . $e->getMessage();
    //     }  
        return view('frontend.auth.new-login'); 
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    // public function username()
    // {
    //     return config('access.users.username');
    // }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // protected function validateLogin(Request $request)
    // {

    //     $request->validate([
    //         // $this->username() => 'required|string',
    //         'mobile_no' => 'required|regex:/[0-9]{10}/|digits:10',
    //         'password' => PasswordRules::login(),
    //         'g-recaptcha-response' => ['required_if:captcha_status,true', 'captcha'],
    //     ], [
    //         'g-recaptcha-response.required_if' => __('validation.required', ['attribute' => 'captcha']),
    //     ]);
    // }

    /**
     * The user has been authenticated.
     *
     * @param Request $request
     * @param         $user
     *
     * @throws GeneralException
     * @return \Illuminate\Http\RedirectResponse
     */
    // protected function authenticated(Request $request, $user)
    // {

    //     // print_r($user);
    //     // print_r($request->all());
    //     // die;

    //     // Check to see if the users account is confirmed and active
    //     if (! $user->isConfirmed()) {
    //         auth()->logout();

    //         // If the user is pending (account approval is on)
    //         if ($user->isPending()) {
    //             throw new GeneralException(__('exceptions.frontend.auth.confirmation.pending'));
    //         }

    //         // Otherwise see if they want to resent the confirmation e-mail

    //         throw new GeneralException(__('exceptions.frontend.auth.confirmation.resend', ['url' => route('frontend.auth.account.confirm.resend', e($user->{$user->getUuidName()}))]));
    //     }

    //     if (! $user->isActive()) {
    //         auth()->logout();

    //         throw new GeneralException(__('exceptions.frontend.auth.deactivated'));
    //     }

    //     event(new UserLoggedIn($user));

    //     if (config('access.users.single_login')) {
    //         auth()->logoutOtherDevices($request->password);
    //     }

    //     return redirect()->intended($this->redirectPath());
    // }


    public function login(Request $request)
    
    {
        $request->validate([
                    // $this->username() => 'required|string',
                    'email' => 'required|email', // Adding email validation
                   // 'mobile_no' => 'required|regex:/[0-9]{10}/|digits:10',
                    'password' => PasswordRules::login(),
                   // 'g-recaptcha-response' => 'required|captcha',
                    //'g-recaptcha-response' => ['required_if:captcha_status,true', 'captcha'],
                ], [
                 //   'g-recaptcha-response' => 'It is required', 
                   // 'g-recaptcha-response.required_if' => __('validation.required', ['attribute' => 'captcha']),
                ]);
        if($request->input('email')){
            $credentials = $request->only('email', 'password');
        }else{
            $credentials = $request->only('mobile_no', 'password');
        }
            
        
        //dd($credentials);
        if (Auth::attempt($credentials)) {

        $user = Auth::user();
        // Check to see if the users account is confirmed and active
            if (! $user->isConfirmed()) {
            // dd($user->isConfirmed());
                auth()->logout();

                // If the user is pending (account approval is on)
                if ($user->isPending()) {
                    throw new GeneralException(__('exceptions.frontend.auth.confirmation.pending'));
                }

                // Otherwise see if they want to resent the confirmation e-mail

                throw new GeneralException(__('exceptions.frontend.auth.confirmation.resend', ['url' => route('frontend.auth.account.confirm.resend', e($user->{$user->getUuidName()}))]));
            }

            if (! $user->isActive()) {
                auth()->logout();
            
                throw new GeneralException(__('exceptions.frontend.auth.deactivated'));
            }
            // die(Auth::user()->hasRole('Employee'));
            event(new UserLoggedIn($user));

            Session::put( 'orig_user', $user->id );
           

            if (config('access.users.single_login')) {
                auth()->logoutOtherDevices($request->password);
            }
            if( Auth::user()->hasRole('Administrator')){
                return redirect()->route('admin.dashboard');
            }
            if($user->profile_step==0){
                return redirect()->route('frontend.auth.service.selection');
                // if(Prescription::where('user_id',$user->id)->exists()){
                //     return redirect()->route('frontend.auth.service.selection');
                // }else{
                //     return redirect()->route('frontend.user.prescription.upload');
                // }
                
            }

            return redirect()->intended($this->redirectPath());
        }

        return redirect("account/login")->withFlashDanger(__('exceptions.frontend.auth.password.wrong_password'));
    }

    public function send_otp(Request $request)
    {
        $isexist = User::where('mobile_no',$request->mobile_no)->first();


        $otp = generateOTP();
        try{
        //     $accountSid = config('app.twilio')['TWILIO_ACCOUNT_SID'];
        //     $authToken = config('app.twilio')['TWILIO_AUTH_TOKEN'];
        //     $client = new Client($accountSid, $authToken);
        //     $message = $client->messages->create('91'.$request->mobile_no, [
        //          'from' => +16475034144,
        //          'body' => 'CODE: '. $otp]);
 
        //          // dd($message);
      
        //  dd($message);
        if($isexist){
            $otp_verified = UserOtp::where('user_id',$isexist->id)->where('status','verified')->first();
            if($otp_verified){
                return json_encode(['error' => 0,'status'=>'exist', 'message' => 'User Already Exist','route'=>'/account/login']);
            }else{
                $otp_unverified = UserOtp::where('user_id',$isexist->id)->where('status','unverified')->first();
                if(!$otp_unverified){
                    $otp_unverified = new UserOtp();
                }
               
                $otp_unverified->user_id = $isexist->id;
                $otp_unverified->otp = $otp;
                if($this->sendSms($request,$otp,($isexist->dialing_code)?$isexist->dialing_code:'1')){
                    if($otp_unverified->save()){
                        if(isset($isexist->email)){
                            $data1 =  $otp.' is the OTP to register to your Mister Pharmacist account. DO NOT disclose it to anyone.';
                           sendMail('mail',null,$data1,$isexist->id,'Verify OTP');
                        }
                        //$this->sendSms($request,$otp);
                        return json_encode(['error' => 0, 'message' => 'Otp Send Successfully','otp'=>'8888']);
                    }else{
                        return json_encode(['error' => 1, 'message' => 'Something went wrong']);
                    }
                }else{
                    return json_encode(['error' => 1, 'message' => 'Check your mobile number']);
                }
              

            }


            }else{
               
        $user = new User();
        $user->password = Hash::make($request->mobile_no);
        $user->mobile_no = $request->mobile_no;
        $user->dialing_code = ($request->dialing_code)?$request->dialing_code:'1';
        $user->avatar_type = 'storage';
        $user->avatar_location = 'avatars/ydHfdoOuza7nvwvtez1S6xzDhWDGyKJgpDDQN3nw.png';
        
        if($this->sendSms($request,$otp,($request->dialing_code)?$request->dialing_code:'1')){
            if($user->save()){
                if(isset($isexist->email)){
                    $data1 =  $otp.' is the OTP to register to your Mister Pharmacist account. DO NOT disclose it to anyone.';
                   sendMail('mail',null,$data1,$isexist->id,'Verify OTP');
                }

            $user->attachRole(3);
            $permissions = $user->roles->first()->permissions->pluck('id');
            $user->permissions()->sync($permissions);
            $userotp = new UserOtp();
            $userotp->user_id = $user->id;
            $userotp->otp = $otp;
            if($userotp->save()){
                
                return json_encode(['error' => 0, 'message' => 'Otp Send Successfully','otp'=>'9999']);
            }else{
                return json_encode(['error' => 1, 'message' => 'Something went wrong']);

            }


       }
    }else{
        return json_encode(['error' => 1, 'message' => 'Check your mobile number']);
    }
        return json_encode(['error' => 1, 'message' => 'Something went wrong']);
        }
    }catch(Exception $e){
        //dd($e);
        return json_encode(['error' => 1, 'message' => 'Something went wrong']);
      //  return json_encode(['error' => 1, 'message' => $e]);
    }
    }

    public function email_send_otp(Request $request)
    {
      
       // dd($request->all());
        // Create the validator
        $validator = \Validator::make($request->all(), [
            'g-recaptcha-response' => 'required',
            'email' => 'required',
        ], [
            'g-recaptcha-response.required' => 'ReCAPTCHA verification is required',
            'email.required' => 'Email is required',
        ]);
        

        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            if(isset($errors['g-recaptcha-response'][0])){
                $error = $errors['g-recaptcha-response'][0];
            }else{
                $error = 'This field is required.';
            }
            return json_encode(['error' => 1,'message' => $error]);

        }
    if ($request->input('g-recaptcha-response')) {
        $client = new Gclient();
        $response = $client->post("https://www.google.com/recaptcha/api/siteverify", [
            'form_params' => [
                'secret' => env('GOOGLE_RECAPTCHA_SECRET'),
                'response' => $request->input('g-recaptcha-response')
            ]
        ]);
        $body = json_decode($response->getBody(), true);
        if(!$body["success"]){
            return json_encode(['error' => 1,'message' => 'The reCAPTCHA field is required']);
        }
    }
        $isexist = User::where('email',$request->email)->first();
        $otp = generateOTP();
        try{
        
            
            if($isexist){
                $otp_verified = UserOtp::where('user_id',$isexist->id)->where('status','verified')->first();
                if($otp_verified){
                    return json_encode(['error' => 0,'status'=>'exist', 'message' => 'User Already Exist','route'=>'/account/login']);
                }else{
                    $otp_unverified = UserOtp::where('user_id',$isexist->id)->where('status','unverified')->first();
                    if(!$otp_unverified){
                        $otp_unverified = new UserOtp();
                    }
                
                    $otp_unverified->user_id = $isexist->id;
                    $otp_unverified->otp = $otp;
                        if($otp_unverified->save()){
                            if(isset($isexist->email)){
                                $data1 =  ': '.$otp.' DO NOT disclose it to anyone';
                                sendMail('mail','patient_email_otp_registration',$data1,$isexist->id,'Two Factor Authentication Code');
                            }
                            //$this->sendSms($request,$otp);
                            return json_encode(['error' => 0, 'message' => 'Otp Send Successfully','otp'=>'8888']);
                        }else{
                            return json_encode(['error' => 1, 'message' => 'Something went wrong']);
                        }
                    
                

                }


            }else{
                $user = new User();
                $user->password = Hash::make($request->input('email'));
                $user->email = $request->input('email');
                $user->dialing_code = '';
                $user->avatar_type = 'storage';
                $user->avatar_location = 'avatars/ydHfdoOuza7nvwvtez1S6xzDhWDGyKJgpDDQN3nw.png';
            
               
                if($user->save()){
                    if(isset($user->email)){
                        $data1 =  $otp.' is the OTP to register to your Mister Pharmacist account. DO NOT disclose it to anyone.';
                        sendMail('mail','without-msg',$data1,$user->id,'Verify OTP');
                    }

                    $user->attachRole(3);
                    $permissions = $user->roles->first()->permissions->pluck('id');
                    $user->permissions()->sync($permissions);
                    $userotp = new UserOtp();
                    $userotp->user_id = $user->id;
                    $userotp->otp = $otp;
                    if($userotp->save()){
                        
                        return json_encode(['error' => 0, 'message' => 'Otp Send Successfully','otp'=>'9999']);
                    }else{
                        return json_encode(['error' => 1, 'message' => 'Something went wrong']);

                    }
                }
                return json_encode(['error' => 1, 'message' => 'Something went wrong']);
            }
        }catch(Exception $e){
            //dd($e);
           // return json_encode(['error' => 1, 'message' => 'Something went wrong']);
          return json_encode(['error' => 1, 'message' => $e->getMessage()]);
        }
    }

    public function sendSms($request,$otp,$dialing_code='1'){
        $accountSid = config('app.twilio')['TWILIO_ACCOUNT_SID'];
        $authToken = config('app.twilio')['TWILIO_AUTH_TOKEN'];
        try{
            $client = new Client($accountSid, $authToken);
            $message = $client->messages->create($dialing_code.$request->mobile_no, [
                'from' => +16475034144,
                'body' => $otp.' is the OTP to register to your Mister Pharmacist account. DO NOT disclose it to anyone.']);
                return 1;
        }
        catch (Exception $e){
         //  dd($e);
            return 0;
        }
    }
    
    public function verify_otp(Request $request)
    {

        $user = User::where('mobile_no',$request->mobile_no)->first();
        if($user ){
            $user_otp = UserOtp::where('user_id',$user->id)->where('otp',$request->otp)->first();
            if($user_otp){
                $user_otp->status = 'verified';
                if($user_otp->save()){
                    $user->confirmation_code=md5(rand(9,12));
                    $user->confirmed=1;
                    $user->save();
                    Auth::loginUsingId($user_otp->user_id);
                    // return redirect()->route('frontend.index');
                    if($user->mobile_no && $user->dialing_code){
                        $mobile = $user->dialing_code.$user->mobile_no;
                        sendMessage($mobile,'mail','patient_account_created',$data=null);
                    }
                    return json_encode(['error' => 0, 'message' => 'Login Successfully','profile_step'=>$user->profile_step]);
                }
            }else{
                return json_encode(['error' => 1, 'message' => 'Otp not match']);
            }
        }
        // $user->password = Hash::make($request->mobile_no);
        // $user->mobile_no = $request->mobile_no;
        return json_encode(['error' => 1, 'message' => 'Something went wrong']);

    }

    public function email_verify_otp(Request $request)
    {

        $user = User::where('email',$request->input('email'))->first();
        if($user){
            $user_otp = UserOtp::where('user_id',$user->id)->where('otp',$request->otp)->first();
            if($user_otp){
                $user_otp->status = 'verified';
                if($user_otp->save()){
                    $user->confirmation_code=md5(rand(9,12));
                    $user->confirmed=1;
                    $user->save();
                    Auth::loginUsingId($user_otp->user_id);
                    // return redirect()->route('frontend.index');
                    if($user->mobile_no && $user->dialing_code){
                        $mobile = $user->dialing_code.$user->mobile_no;
                        sendMessage($mobile,'mail','patient_account_created',$data=null);
                    }
                    return json_encode(['error' => 0, 'message' => 'Login Successfully','profile_step'=>$user->profile_step]);
                }
            }else{
                return json_encode(['error' => 1, 'message' => 'Otp not match']);
            }
        }
        // $user->password = Hash::make($request->mobile_no);
        // $user->mobile_no = $request->mobile_no;
        return json_encode(['error' => 1, 'message' => 'Something went wrong']);

    }


    /**
     * Log the user out of the application.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        // Remove the socialite session variable if exists
        if (app('session')->has(config('access.socialite_session_name'))) {
            app('session')->forget(config('access.socialite_session_name'));
        }

        // Fire event, Log out user, Redirect
        event(new UserLoggedOut($request->user()));

        // Laravel specific logic
        $this->guard()->logout();
        $request->session()->invalidate();

        return redirect()->route('frontend.index');
    }


}

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
        return view('frontend.auth.login');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showNewLoginForm()
    {
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
                    'mobile_no' => 'required|regex:/[0-9]{10}/|digits:10',
                    'password' => PasswordRules::login(),
                    'g-recaptcha-response' => ['required_if:captcha_status,true', 'captcha'],
                ], [
                    'g-recaptcha-response.required_if' => __('validation.required', ['attribute' => 'captcha']),
                ]);

        $credentials = $request->only('mobile_no', 'password');
        if (Auth::attempt($credentials)) {

        $user = Auth::user();
        // Check to see if the users account is confirmed and active
        if (! $user->isConfirmed()) {
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

        event(new UserLoggedIn($user));

        if (config('access.users.single_login')) {
            auth()->logoutOtherDevices($request->password);
        }

        return redirect()->intended($this->redirectPath());
        }

        return redirect("account/login")->withFlashDanger(__('exceptions.frontend.auth.password.wrong_password'));
    }

    public function send_otp(Request $request)
    {
        $isexist = User::where('mobile_no',$request->mobile_no)->first();
        $otp_verified = UserOtp::where('user_id',$isexist->id)->where('status','verified')->first();

        $otp = generateOTP();
        try{
        if($isexist && $otp_verified){
            return json_encode(['error' => 0,'status'=>'exist', 'message' => 'User Already Exist','route'=>'/account/login']);


            }else{
                $serotp = User::where('mobile_no',$request->mobile_no)->first();
                $otp_verified = UserOtp::where('user_id',$isexist->id)->where('status','unverified')->first();
                if($serotp && $otp_verified){
                    $otp_verified->user_id = $serotp->id;
                $otp_verified->otp = $otp;
                if($otp_verified->save()){
                    $this->sendSms($request,$otp);
                    return json_encode(['error' => 0, 'message' => 'Otp Send Successfully','otp'=>$serotp->otp]);
                }else{
                    return json_encode(['error' => 1, 'message' => 'Something went wrong']);
                }
                }

        $user = new User();
        $user->password = Hash::make($request->mobile_no);
        $user->mobile_no = $request->mobile_no;
        $user->avatar_type = 'storage';
        $user->avatar_location = 'avatars/ydHfdoOuza7nvwvtez1S6xzDhWDGyKJgpDDQN3nw.png';
        if($user->save()){

            $user->attachRole(3);
            $permissions = $user->roles->first()->permissions->pluck('id');
            $user->permissions()->sync($permissions);
            $userotp = new UserOtp();
            $userotp->user_id = $user->id;
            $userotp->otp = $otp;
            if($userotp->save()){
                $this->sendSms($request,$otp);
                return json_encode(['error' => 0, 'message' => 'Otp Send Successfully','otp'=>$userotp->otp]);
            }else{
                return json_encode(['error' => 1, 'message' => 'Something went wrong']);

            }


       }
        return json_encode(['error' => 1, 'message' => 'Something went wrong']);
        }
    }catch(Exception $e){
        dd($e);
        return json_encode(['error' => 1, 'message' => $e]);
    }
    }

    public function sendSms($request,$otp){
        $accountSid = config('app.twilio')['TWILIO_ACCOUNT_SID'];
        $authToken = config('app.twilio')['TWILIO_AUTH_TOKEN'];
        try{
            // $client = new Client(['auth' => [$accountSid, $authToken]]);

            // $result = $client->post('https://api.twilio.com/2010-04-01/Accounts/'.$accountSid.'/Messages.json',
            // ['form_params' => [
            // 'Body' => 'CODE: '. $otp, //set message body
            // 'To' => $request->mobile_no,
            // 'From' => '+16475034144' //we get this number from twilio
            // ]]);
            //return $result;

            $client = new Client($accountSid, $authToken);
           $message = $client->messages->create($request->mobile_no, [
                'from' => +16475034144,
                'body' => 'CODE: '. $otp]);

                // dd($message);
        }
        catch (Exception $e){

        //    dd($e);
            return json_encode(['error' => 1, 'message' => $e]);
      //  echo "Error: " . $e->getMessage();
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
                    $user->save();
                    Auth::loginUsingId($user_otp->user_id);
                    // return redirect()->route('frontend.index');
                    return json_encode(['error' => 0, 'message' => 'Login Successfully','route'=>'dashboard']);
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

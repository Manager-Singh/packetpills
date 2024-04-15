<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use AWS;

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
    protected function sms($phone_number){
        $sms = AWS::createClient('sns');

        $nsms = $sms->publish([
            'Message' => 'Hello, This is just a test Message',
            'PhoneNumber' => $phone_number,
            'MessageAttributes' => [
                'AWS.SNS.SMS.SMSType'  => [
                    'DataType'    => 'String',
                    'StringValue' => 'Transactional',
                 ]
           ],
        ]);

        print_r($nsms);
    }
    

}

<?php

use Illuminate\Support\Str;
use Twilio\Rest\Client;
use App\Models\AutoMessage;
use App\Models\MailMessage;
use App\Models\Province;
use App\Models\MedicationItem;
use App\Models\Auth\User;
use Illuminate\Support\Facades\Mail;
use App\Models\Prescription;
use App\Models\PrescriptionIteam;
use Illuminate\Support\Facades\Session;
use PHPMailer\PHPMailer\PHPMailer;
use App\Models\Setting;
use App\Models\PrescriptionRefill;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request;
use App\Models\PrescriptionOld;
use App\Models\Order;
use App\Models\OrderItem;
//use PHPMailer\PHPMailer\Exception;
use Aws\Laravel\AwsFacade as AWS;

/**
 * Henerate UUID.
 *
 * @return uuid
 */
function generateUuid()
{
    return Str::uuid();
}

if (! function_exists('homeRoute')) {
    /**
     * Return the route to the "home" page depending on authentication/authorization status.
     *
     * @return string
     */
    function homeRoute()
    {
        if (access()->allow('view-backend')) {
            return 'admin.dashboard';
        } elseif (auth()->check()) {
            return 'frontend.user.dashboard';
        }

        return 'frontend.index';
    }
}

// Global helpers file with misc functions.
if (! function_exists('app_name')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function app_name()
    {
        return config('app.name');
    }
}

if (! function_exists('access')) {
    /**
     * Access (lol) the Access:: facade as a simple function.
     */
    function access()
    {
        return app('access');
    }
}

if (! function_exists('history')) {
    /**
     * Access the history facade anywhere.
     */
    function history()
    {
        return app('history');
    }
}

if (! function_exists('gravatar')) {
    /**
     * Access the gravatar helper.
     */
    function gravatar()
    {
        return app('gravatar');
    }
}

if (! function_exists('includeRouteFiles')) {
    /**
     * Loops through a folder and requires all PHP files
     * Searches sub-directories as well.
     *
     * @param $folder
     */
    function includeRouteFiles($folder)
    {
        $directory = $folder;
        $handle = opendir($directory);
        $directory_list = [$directory];

        while (false !== ($filename = readdir($handle))) {
            if ($filename != '.' && $filename != '..' && is_dir($directory.$filename)) {
                array_push($directory_list, $directory.$filename.'/');
            }
        }

        foreach ($directory_list as $directory) {
            foreach (glob($directory.'*.php') as $filename) {
                require $filename;
            }
        }
    }
}

if (! function_exists('getRtlCss')) {
    /**
     * The path being passed is generated by Laravel Mix manifest file
     * The webpack plugin takes the css filenames and appends rtl before the .css extension
     * So we take the original and place that in and send back the path.
     *
     * @param $path
     *
     * @return string
     */
    function getRtlCss($path)
    {
        $path = explode('/', $path);
        $filename = end($path);
        array_pop($path);
        $filename = rtrim($filename, '.css');

        return implode('/', $path).'/'.$filename.'.rtl.css';
    }
}

if (! function_exists('escapeSlashes')) {
    /**
     * Access the escapeSlashes helper.
     */
    function escapeSlashes($path)
    {
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $path);
        $path = str_replace('//', DIRECTORY_SEPARATOR, $path);
        $path = trim($path, DIRECTORY_SEPARATOR);

        return $path;
    }
}

if (! function_exists('getRouteUrl')) {
    /**
     * Converts querystring params to array and use it as route params and returns URL.
     */
    function getRouteUrl($url, $url_type = 'route', $separator = '?')
    {
        $routeUrl = '';

        if (! empty($url)) {
            if ($url_type == 'route') {
                if (strpos($url, $separator) !== false) {
                    $urlArray = explode($separator, $url);
                    $url = $urlArray[0];
                    parse_str($urlArray[1], $params);
                    $routeUrl = route($url, $params);
                } else {
                    $routeUrl = route($url);
                }
            } else {
                $routeUrl = $url;
            }
        }

        return $routeUrl;
    }
}

if (! function_exists('renderMenuItems')) {
    /**
     * render sidebar menu items after permission check.
     */
    function renderMenuItems($items, $viewName = 'backend.includes.partials.sidebar-item')
    {
        foreach ($items as $item) {
            // if(!empty($item->url) && !Route::has($item->url)) {
            //     return;
            // }
            if (! empty($item->view_permission_id)) {
                if (access()->allow($item->view_permission_id)) {
                    echo view($viewName, compact('item'));
                }
            } else {
                echo view($viewName, compact('item'));
            }
        }
    }
}

if (! function_exists('checkDatabaseConnection')) {
    /**
     * @return bool
     */
    function checkDatabaseConnection()
    {
        try {
            DB::connection()->reconnect();

            return true;
        } catch (Exception $ex) {
            return false;
        }
    }
}

if (! function_exists('authUserShortName')) {
    /**
     * @return string
     */
    function authUserShortName()
    {
        try {
            if(auth()->check()){
                $user = auth()->user();
                if(!empty($user->first_name) && !empty($user->last_name)){
                    return substr(ucfirst($user->first_name), 0, 1).''.substr(ucfirst($user->last_name), 0, 1);
                }elseif(!empty($user->first_name) && empty($user->last_name)){
                    return substr($user->first_name, 0, 2);
                }else{
                    return 'MP';
                }

            }

            return true;
        } catch (Exception $ex) {
            return false;
        }
    }
}
if (! function_exists('sendMessage')) {

    function sendMessage($mobile_no=null,$type,$message_for=null,$data){
        if($type=='admin'){
           
           $body = $data."\n\n"."MisterPharmacist"."\n"." Online Pharmacy.";
        }else{
            $message = MailMessage::where('message_for',$message_for)->where('status',1)->first();
            
            if(!$message){
                return true;
            }else{
                $body = (isset($message->sms_message)) ? $message->sms_message : 'Welcome';
            }
           
           if($data!==null){
            $body .= "\n".$data;
           }
           $body .= "\n\n"."MisterPharmacist"."\n"."Online Pharmacy. "."\n"."DO NOT REPLY to this automated text. Our text only message system is 416-593-4000";
        }
       
        
        
        $accountSid = config('app.twilio')['TWILIO_ACCOUNT_SID'];
        $authToken = config('app.twilio')['TWILIO_AUTH_TOKEN'];
        try{
            $client = new Client($accountSid, $authToken);
            $messagesend = $client->messages->create($mobile_no, [
                'from' => +16475034144,
                'body' => $body]);

            return 1;
        }
        catch (Exception $e){
        // dd($e);
            return 0;
        }
    }
}



if (! function_exists('sendMail')) {
    function sendMail($type,$message_for=null,$data,$user_id = null,$subject=null,$email=null,$existing_data=null){
        $user = User::where('id',$user_id)->first();
        $setting = Setting::first();
        $body = '';
        if(isset($user) && empty($user->email)){
            return true;
        }
        if($type=='admin'){
           
            // $body = $data."\n\n"."MisterPharmacist"."\n"." Online Pharmacy.";
            $body = $data;
         }else{
            $message = MailMessage::where('message_for',$message_for)->where('status',1)->first();
           
            if(!$message){
                if( $message_for == 'without-msg'){
                    //$body = $data;
                    $body = '';
                }else{
                    return true;
                }
                
            }else{
                $body = $message->message;
            }
            
            if($data!==null){
             $body .= "\n".$data;
            }
           // $body .= "\n\n"."MisterPharmacist"."\n"." Online Pharmacy.";
        }
        
        $full_name = $user->first_name.' '.$user->last_name;
        $to_name = $full_name;
        if($email){
            $to_email = $email;
        }else{
            $to_email = $user->email;
        }
       
        if($existing_data){
            $template_name = 'emails.'.$existing_data['template'];
            $exist_data = isset($existing_data['data']) ? $existing_data['data'] : '';
            $data = array("name" => $full_name, "body" => $body, 'setting' => $setting,'existing'=>$exist_data);
        }else{
            $template_name = 'emails.mail';
            $data = array("name" => $full_name, "body" => $body, 'setting' => $setting);
        }
        try{
        $aaaa = Mail::send($template_name, $data, function($message) use ($to_name, $to_email,$subject) {
        $message->to($to_email, $to_name);
        $message->subject($subject);
        $message->from(env('MAIL_FROM_ADDRESS', 'rx@misterpharmacist.com'),"Toronto's Online Pharmacy");
        });
        return 1;
    }
    catch (Exception $e){
      dd($e);
     
    //$e->getMessage()
        return 0;
    }
    }
}



if (! function_exists('getAllProvince')) {
    /**
     * @return bool
     */
    function getAllProvince()
    {
        return Province::get();
    }
}

if (! function_exists('getTotalAmount')) {
    /**
     * @return bool
     */
    function getTotalAmount($ids_array)
    {
        $sum = MedicationItem::whereIn('id', $ids_array)->sum('price');
        // print_r($sum);
        // die;
        return $sum;
    }
}

if (! function_exists('getPrice')) {
    /**
     * @return bool
     */
    function getPrice($id)
    {
        $price = MedicationItem::where('id', $id)->first()->price;
        // print_r($sum);
        // die;
        return $price;
    }
}

if (! function_exists('getPrescriptionData')) {
    /**
     * @return bool
     */
    function getPrescriptionData($id)
    {
        $prescription = Prescription::where('id', $id)->first();
        return $prescription;
    }
}

if (! function_exists('getAllChildUsers')) {
    /**
     * @return bool
     */
    function getAllChildUsers()
    {
        
        $user = auth()->user();
        if(isset($user->parent_id) && !empty($user->parent_id)){
            $user = User::find($user->parent_id);
        }else{
            $user = User::where('id',$user->id)->where('parent_id',null)->first();
        }
        
       
        if($user){
            $orig_user = User::where('id',$user->id)->with('subuser')->get();
            
            return $orig_user;
            
        }
        return false;
        
        
    }
}

if (! function_exists('orderStatusText')) {
    /**
     * @return bool
     */
    function orderStatusText($order_status)
    {
        $order_status_array = [
            'pending'=>'Pending',
            'approved'=>'Approved',
            'cancelled'=>'Cancelled',
            'declined'=>'Declined',
            'processing'=>'Processing',
            'ready_to_pick'=>'Ready To Pick',
            'picked_up'=>'Picked Up',
            'in_transit'=>'In Transit',
            'delivered'=>'Delivered'
            ];
        
        if($order_status){
            foreach($order_status_array as $key => $value ){

                if($key == $order_status){
                    return $value;
                }
            }
        }
    }
}

if (! function_exists('getPrescriptionRefill')) {
    /**
     * @return bool
     */
    function getPrescriptionRefill($id)
    {
        $user = Auth::user();
        $prescription = PrescriptionRefill::where('user_id',$user->id)->where('prescription_id',$id)->orderBy('created_at','desc')->get();
        return $prescription;
    }
}


if (! function_exists('getGoogleApiTextSearch')) {
    /**
     * @return bool
     */
    function getGoogleApiTextSearch($query)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://maps.googleapis.com/maps/api/place/textsearch/json?'.$query,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            ));
    
            $response = json_decode(curl_exec($curl));
    
            curl_close($curl);
            return $response;

            
        
    }
}


if (! function_exists('getGoogleApiTextSearch11')) {
    /**
     * @return bool
     */
    function getGoogleApiTextSearch11($search)
    {
        $client = new GuzzleClient(); // Create a new instance of Guzzle HTTP client
        $baseUrl = 'https://maps.googleapis.com/maps/api/place/textsearch/json';
        $key = env('GOOGLE_API_KEY'); // Replace with your actual API key
        $query = 'pharmacy ' . $search . ' in Canada';
        $limit = 20; // You can adjust the limit as needed
        $pageToken = null;
        $data_array = [];
        $count = 0;
    
        do {
            // Construct the request URL including pagination token if available
            $url = $baseUrl . '?key=' . $key . '&query=' . urlencode($query);
            if ($pageToken !== null) {
                $url .= '&nextpage=' . $pageToken;
            }
            // Send the request
            $res = $client->request('GET', $url); // Use request() method instead of send()
            $data = json_decode($res->getBody(),true);
            // Output or process the results as needed

            
            
            if(isset($data['results'])){
                $data_array = array_merge($data_array, $data['results']);
            } else {
                // No more results or an error occurred
                break;
            }

            // Update the page token for the next iteration
            $pageToken = isset($data['next_page_token']) ? $data['next_page_token'] : null;
    
            // Google Places API has a rate limit, so you might want to introduce a small delay
            // before making the next request
            usleep(500000); // Sleep for 0.5 seconds (500,000 microseconds)
            $count++;
        } while ($pageToken !== null && count($data_array) < 100);

        //dd($data_array);
        return $data_array;
    }
}


if (! function_exists('getGoogleApiTextSearchPaginate')) {
    /**
     * @return bool
     */
    function getGoogleApiTextSearchPaginate($search,$pageToken = null)
    {
        $client = new GuzzleClient(); // Create a new instance of Guzzle HTTP client
        $baseUrl = 'https://maps.googleapis.com/maps/api/place/textsearch/json';
        $key = env('GOOGLE_API_KEY'); // Replace with your actual API key
        $query = 'pharmacy ' . $search . ' in Canada';
        $limit = 20; // You can adjust the limit as needed
        
        $data_array = [];
        
       
            // Construct the request URL including pagination token if available
            $url = $baseUrl . '?key=' . $key . '&query=' . urlencode($query);
            if ($pageToken !== null) {
                $url .= '&pagetoken=' . $pageToken;
            }
            // Send the request
            $res = $client->request('GET', $url); // Use request() method instead of send()
            $data = json_decode($res->getBody());
            // Output or process the results as needed

            if($data){
               return $data;
            }
            
        return false;
    }
}


if (! function_exists('countPendingActivity')) {
    /**
     * @return bool
     */
    function countPendingActivity($type,$user_id,$status='pending')
    {
        
        if( $type == 'prescription_refill'){
            return PrescriptionRefill::where('user_id',$user_id)->where('status', $status)->count();
        }elseif($type == 'existing_prescription_refill'){
            return PrescriptionOld::where('user_id',$user_id)->where('status', $status)->count();
        }elseif($type == 'orders'){
            return Order::where('user_id',$user_id)->where('order_status', $status)->count();
        }elseif($type == 'medications'){
            //$medication_item = MedicationItem::orWhereDoesntHave('orders')->where('user_id',$user_id)->where('status','=','active')->count();
            $medication_item = MedicationItem::doesntHave('order_item')
            ->where('user_id', $user_id)
            ->where('status', 'active')
            ->count();
            return $medication_item;
        }

        
        
    }
}


if (!function_exists('send_sms')) {
    function send_sms($phone_number, $message) {
        $sns = AWS::createClient('sns');

        $result = $sns->publish([
            'Message' => $message,
            'PhoneNumber' => $phone_number,
            'MessageAttributes' => [
                'AWS.SNS.SMS.SMSType' => [
                    'DataType' => 'String',
                    'StringValue' => 'Transactional',
                ]
            ],
        ]);

        return $result;
    }
}

if (!function_exists('medicationOrderStatus')) {
    function medicationOrderStatus($medication_id) {
        
        if(OrderItem::where('medication_id',$medication_id)->exists()){
            return '<span class="badge badge-warning" style="font-size: 12px;">Ordered</span>';
            
        }else{
            return '';
        }
    }
}








<?php
namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Auth\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;
use App\Models\HealthInformation;
use App\Models\PaymentMethod;
use App\Models\Province;
use App\Models\Insurance;
use App\Models\HealthCard;
use App\Models\Drug;
use App\Models\Prescription;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\TransferRequest;
use Illuminate\Support\Facades\Session;
use App\Models\Auth\User;
use App\Models\PrescriptionRefill;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\UserOtp;
use App\Models\UserReferal;
use Twilio\Rest\Client;
use App\Models\PrescriptionOld;
use Validator;
use App\Models\MedicationItem;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{

    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        
        $this->userRepository = $userRepository;
        

        // $this->middleware(function ($request, $next) {
           
        //     if(Auth::check() && Auth::user()->is_profile_status == "completed"){
        //         return redirect()->route('frontend.user.dashboard');
        //     }else{
        //         return $next($request);
        //     }
            
        // });
        

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
        if(Auth::check() && Auth::user()->is_profile_status == "completed" && Auth::user()->is_referred_updated =='yes'){
            return redirect()->route('frontend.user.dashboard');
        }
        return view('frontend.auth.steps.service-selection');
    }

    public function stepTransfer(){
        return view('frontend.auth.steps.transfer');
    }
    public function prescription(){
        return view('frontend.auth.steps.prescription');
    }
    public function telehealth(){
        if(Auth::check() && Auth::user()->is_profile_status == "completed" && Auth::user()->is_referred_updated =='yes'){
            return redirect()->route('frontend.user.dashboard');
        }
        return view('frontend.auth.steps.telehealth');
    }
    public function personal(){
        if(Auth::check() && Auth::user()->is_profile_status == "completed" && Auth::user()->is_referred_updated =='yes'){
            return redirect()->route('frontend.user.dashboard');
        }
        
        return view('frontend.auth.steps.personal');
    }

    public function accountReferral(){
        if(Auth::check() && Auth::user()->is_profile_status == "completed" && Auth::user()->is_referred_updated =='yes'){
            return redirect()->route('frontend.user.dashboard');
        }
        $user_refs = UserReferal::with('user')->where('user_id',Auth::user()->id)->first(); 
        return view('frontend.auth.steps.referral')->with(['user_ref'=>$user_refs]);
    }

    public function accountReferralUpdate(Request $request)
    {

        // print_r('<pre>');
        // print_r($request->all());
        // print_r('</pre>');
        // die;
        try {
            // Get authenticated user
            $user = Auth::user();
    
            // Check if the user has already updated referral data
            // if ($user->is_referred_updated == 'yes') {
            //     return redirect()
            //         ->back()
            //         ->with('error', 'You have already updated your referral information.');
            // }
    
            // Validate the request
            $validatedData = $request->validate([
                'from_you_found' => 'required|string|in:instagram,twitter,facebook,email,other,refer-by-user',
                'other_message' => 'nullable|string|required_if:from_you_found,other',
                'name' => 'nullable|string|required_if:from_you_found,refer-by-user',
                'refred_by' => 'nullable|string|required_if:from_you_found,refer-by-user',
                'email' => 'nullable|email',
                // 'email' => 'nullable|email|required_if:from_you_found,refer-by-user',
                // 'contact_number' => 'nullable|string|required_if:from_you_found,refer-by-user',
            ], [
                'from_you_found.required' => 'Please select where you found us.',
                'from_you_found.in' => 'Invalid selection for where you found us.',
                'other_message.required_if' => 'Please enter a message if you selected "Other".',
                'name.required_if' => 'Please enter a name if referred by a user.',
                'refred_by.required_if' => 'Please Select referred by.',
                // 'email.required_if' => 'Please enter an email if referred by a user.',
                'email.email' => 'Please enter a valid email address.',
                // 'contact_number.required_if' => 'Please enter a contact number if referred by a user.',
            ]);
    
            // Check if the provided email exists in the users table
            $refrealUserId = null;
            if ($request->from_you_found === 'refer-by-user' && $request->email) {
                $refUser = User::where('email', $request->email)->first();
                $refrealUserId = $refUser ? $refUser->id : null;
            }
    
            // Create or update referral record
            UserReferal::updateOrCreate(
                ['user_id' => $user->id], // Search condition
                [
                    'from_you_found' => $request->from_you_found,
                    'other_message' => $request->from_you_found === 'other' ? $request->other_message : null,
                    'name' => $request->from_you_found === 'refer-by-user' ? $request->name : null,
                    'refred_by' => $request->from_you_found === 'refer-by-user' ? $request->refred_by : null,
                    'email' => $request->from_you_found === 'refer-by-user' ? $request->email : null,
                    'contact_number' => $request->from_you_found === 'refer-by-user' ? $request->contact_number : null,
                    'refreal_user_id' => $refrealUserId, // Assign the found user ID or null
                ]
            );
    
            // Update the authenticated user to mark referral as updated
            User::where('id', $user->id)->update(['is_referred_updated' => 'yes']);
            return redirect()
                ->route('frontend.user.dashboard') // Change this to the correct route
                ->with('success', 'Referral information updated successfully.');
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()
                ->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Something went wrong. Please try again later.');
        }
    }

    public function personal_update(Request $request){

        if(isset($request->alternate_phone)){
            $alternate_phone = $request->alternate_phone;

        }else{
            $alternate_phone = '';
        }

        $output = $this->userRepository->update(
            Auth::user(),
            ['gender_identity'=>$request->gender_identity,'self_described'=>$request->self_described,'pronouns'=>$request->pronouns, 'custom_pronouns'=>$request->custom_pronouns, 'first_name'=>$request->first_name, 'last_name'=>$request->last_name, 'date_of_birth'=>$request->date.'-'.$request->month.'-'.$request->year,'gender'=>$request->gender,'alternate_phone'=>$alternate_phone],
            $request->has('avatar_location') ? $request->file('avatar_location') : false
        );

        if($output){
            return redirect()->route('frontend.user.personal.details')->withFlashSuccess(__('Information Updated'));
        }else{
            return redirect()->back()->withFlashInfo(__('Something went wrong'));
        }

    }
    public function personal_save(Request $request){
       
        $output = $this->userRepository->update(
            Auth::user(),
            ['dialing_code'=>$request->dialing_code,'mobile_no'=>$request->mobile_no,'pronouns'=>$request->pronouns, 'custom_pronouns'=>$request->custom_pronouns, 'first_name'=>$request->first_name, 'last_name'=>$request->last_name, 'date_of_birth'=>$request->date.'-'.$request->month.'-'.$request->year,'profile_step'=>1],
            $request->has('avatar_location') ? $request->file('avatar_location') : false
        );

        if($output){
            return redirect()->route('frontend.auth.step.almostdone')->withFlashSuccess(__('Information Updated'));
        }else{
            return redirect()->back()->withFlashInfo(__('Something went wrong'));
        }

    }
    public function almostdone(){
        if(Auth::check() && Auth::user()->is_profile_status == "completed" && Auth::user()->is_referred_updated =='yes'){
            return redirect()->route('frontend.user.dashboard');
        }

        return view('frontend.auth.steps.almostdone');
    }
    public function almostdone_save(Request $request){

        $user = Auth::user();
        if(isset($request->email) && User::where('email',$request->email)->where('avatar_type','=!','google')->exists()){
            return redirect()->back()->withFlashInfo(__('      This  email ( '.$request->email.' ) already exists.')); 
        }
        // 'province'=>$request->province,

        if($user && !empty($user->parent_id)){

            $array= ['gender'=>$request->gender,'province'=>$request->province,'profile_step'=>3,'is_profile_status' =>'completed'];
        
        }else{

            $array = ['gender'=>$request->gender, 'email'=>$request->email, 'province'=>$request->province,'profile_step'=>2];
        }
        $array['gender_identity']=$request->gender_identity;
        $array['self_described']=$request->self_described;
        

       
        $output = $this->userRepository->update(
            Auth::user(),
            $array,
            $request->has('avatar_location') ? $request->file('avatar_location') : false
        );

        if($output){
            return redirect()->route('frontend.auth.step.create.password')->withFlashSuccess(__('Information Updated'));
        }else{
            return redirect()->back()->withFlashInfo(__('Something went wrong'));
        }

    }
    public function createPassword(){
        if(Auth::check() && Auth::user()->is_profile_status == "completed" && Auth::user()->is_referred_updated =='yes'){
            return redirect()->route('frontend.user.dashboard');
        }
        
        return view('frontend.auth.steps.create-password');
    } 

    public function createPassword_save(Request $request){

        //dd($request->all());
        // 'province'=>$request->province,
        $output = $this->userRepository->update(
            Auth::user(),
            ['password'=>$request->password,'password_updated'=>$request->password_updated,'profile_step'=>3,'is_profile_status' =>'completed'],
            $request->has('avatar_location') ? $request->file('avatar_location') : false
        );

        if($output){
            return redirect()->route('frontend.auth.step.profile.completed')->withFlashSuccess(__('Information Updated'));
        }else{
            return redirect()->back()->withFlashInfo(__('Something went wrong'));
        }

    }


    public function profileCompleted(){
        
        if(Auth::check() && Auth::user()->is_referred_updated =='no'){
            return redirect()->route('frontend.auth.step.referral.completed');
        }

        return view('frontend.auth.steps.profile-completed');
    }
    public function prescripitonRefillAjax(Request $request){

       
        // Render the Blade view to HTML
        $data['prescription'] = Prescription::where('id',$request->prescription_id)->first();
        
        $html = view('frontend.user.prescription-refill',$data)->render();

        // Encode the HTML into JSON format
        $jsonResponse = [
        'html' => $html
        ];

        // Return the JSON response
        return response()->json($jsonResponse);
        
    }

    public function userPrescripiton(Request $request)
    {
       $user = Auth::user();
        $data['prescriptions'] = Prescription::where('user_id',$user->id)->orderBy('created_at','desc')->get();
        $data['prescription_refills'] = PrescriptionRefill::where('user_id',$user->id)->orderBy('created_at','desc')->get();
        
         //dd($data['prescription_refills'][0]['prescription']['medications']);
        
        $data['prescriptions_old'] = PrescriptionOld::where('user_id',$user->id)->orderBy('created_at','desc')->get();

       //dd($data['prescriptions'][0]);
        //dd('sss');
        
        if($request->input('isrefill') == 'yes'){
            if(!Prescription::where('user_id',$user->id)->where('status','approved')->exists()){
                Session::flash('flash_warning', __('You do not have any prescriptions posted in your account.<br>You can request a refill for past prescriptions.<br>A pharmacy team member will follow up with you once your request is made.<br>Thank you!'));
            }else{
                Session::forget('flash_warning');
            }
            return view('frontend.user.prescription',$data); 
        }else{
            Session::forget('flash_warning');
           
            return view('frontend.user.prescription',$data); 
        }
        
    }
    public function userPrescripitonDelete($id){
        $prescription = Prescription::find($id);
        $user = Auth::user();
       
        
        if($prescription->delete()){
          return redirect()->back()->withFlashSuccess(__('Prescription deleted.'));
        }else{
            return redirect()->back()->withFlashInfo(__('Something went wrong'));
        }
    }
    public function userPrescripitonRefill(Request $request){

        if(!$request->has('prescription_id') || !$request->has('medication_ids')){
            return redirect()->back()->withFlashInfo(__('Something went wrong'));
        }
        $prescription = Prescription::find($request->input('prescription_id'));
        $count = 0;
        $user = Auth::user();
        $medication_ids = $request->input('medication_ids');
        if($medication_ids){
            foreach($medication_ids as $medication_id){
                $prescriptionRefill = new PrescriptionRefill();
                $prescriptionRefill->prescription_id =  $request->input('prescription_id');
                $prescriptionRefill->user_id =  $user->id;
                $prescriptionRefill->medication_id =  $medication_id;
                $prescriptionRefill->status =  'pending';
                $prescriptionRefill->save();
                $count++;
            }

        }

        
        $medications = MedicationItem::whereIn('id',$medication_ids)->get();
        $patient_details = array(
            'name' =>$user->full_name,
            'dob' =>$user->date_of_birth,
            'mobile' =>$user->mobile_no,
            'email' =>$user->email,
            'prescription_id' =>$prescription->prescription_number,
        );

        $email_data = array('template'=>'refill-email','data'=>array('medications'=>$medications,'patient'=>$patient_details));
        
        //dd($email_data['data']);
        if($count>0){
            
            if(isset($user->parent_id) && !empty($user->parent_id)){ 
                $parient_name = $user->full_name;
                $user = User::where('id',$user->parent_id)->first(); 
                
            }
            $data =  'Hello MisterPharmacist team!';
          
            $data_u =$user->full_name;
            // send messages to users
            $mobile = $user->dialing_code.$user->mobile_no;
            //sendMessage($mobile,'mail','prescription_refill_created',$data_u);
            if(isset($user->email)){
                sendMail('mail','prescription_refill_created',$data_u,$user->id,'Prescription Refill');
            }

            //send messages to admin
            $admin = User::whereHas('roles', function ($subQuery) { 
                            $subQuery->where('name', 'Administrator');
                        })->first();
            $adminmobile = $admin->dialing_code.$admin->mobile_no;
                    //sendMessage($adminmobile,'admin',null,$data);
                    if(isset($admin->email)){
                        sendMail('admin',null,$data,$admin->id,'Prescription Refill',null,$email_data);
                    }
           return redirect()->back()->withFlashSuccess(__('Prescription refill created.'));
        }else{
            return redirect()->back()->withFlashInfo(__('Something went wrong'));
        }
    }

    public function singleUserPrescripiton(Request $request,$prescription_number)
    {
        $user = Auth::user();
        $data['prescription'] = Prescription::where('prescription_number',$prescription_number)->first();
        //dd($data['prescription']->prescription_iteams);
        return view('frontend.user.single-prescription',$data); 
    }


    public function medications()
    {
         return view('frontend.user.medication'); 
    }
    public function orders()
    {
        $user = Auth::user();
        $data['orders']= Order::where('user_id',$user->id)->with(['prescription','order_items','order_items.medication','order_items.medication.prescription'])->has('order_items')->orderBy('created_at','desc')->get();
        $data['user']=$user;
        return view('frontend.user.order',$data); 
    }
    public function singleOrder(Request $request,$order_no)
    {
        $user = Auth::user();
        $data['order']= Order::where('order_number',$order_no)->with(['prescription','order_items','order_items.medication','order_items.medication.prescription'])->has('order_items')->first();
        $data['user']=$user;
        $data['address']=$user->defaultAddress;
        $data['paymentmethod']=$user->defaultpaymentmethod;
       //dd($user->defaultpaymentmethod);

        //dd($data['order']);
        return view('frontend.user.order-single',$data); 
    }
    public function healthCard()
    {
        $user = Auth::user();
        $data['healthCard']= HealthCard::where('user_id',$user->id)->first();
        //dd($data['healthCard']);
        return view('frontend.user.health-card',$data); 
    }
    public function healthInformation()
    {
        $user = Auth::user();
        $data['health_info']= HealthInformation::where('user_id',$user->id)->first();
        return view('frontend.user.health-information',$data); 
    }
    public function healthInformationsave(Request $request){
        
        $data = collect($request->all())->toArray();
        $output = $this->userRepository->createHealthInformation($data);
        if($output){
            return redirect()->back()->withFlashSuccess(__('Health Information Updated'));
        }else{
            return redirect()->back()->withFlashInfo(__('Something went wrong'));
        }
        
    }
    public function healthCardsave(Request $request){
        
        
        $data = collect($request->all())->toArray();
        $output = $this->userRepository->createHealthCard($data);
        if($output){
            return redirect()->back()->withFlashSuccess(__('HealthCard Information Updated'));
        }else{
            return redirect()->back()->withFlashInfo(__('Something went wrong'));
        }
        
    }
    public function insurance(){
        $user = Auth::user();
        $data['primary_insurance']= Insurance::where('type','primary')->where('user_id',$user->id)->first();
        $data['secondary_insurance']= Insurance::where('type','secondary')->where('user_id',$user->id)->first();
        $data['tertiary_insurance']= Insurance::where('type','tertiary')->where('user_id',$user->id)->first();
        $data['quaternary_insurance']= Insurance::where('type','quaternary')->where('user_id',$user->id)->first();
        $data['is_insurance']= ($user->is_insurance) ? $user->is_insurance : null ;
        return view('frontend.user.insurance',$data); 
    }
    public function insuranceSave(Request $request){
        
        //dd($request->all());
        $data = collect($request->all())->toArray();
        $output = $this->userRepository->createInsurance($data);
        if($output){
            return redirect()->back()->withFlashSuccess(__('Insurance Information Updated'));
        }else{
            return redirect()->back()->withFlashInfo(__('Something went wrong'));
        }
        
    }
    public function address(){
        $user = Auth::user();
        $data['address']= Address::where('user_id',$user->id)->orderBy('id','desc')->get();
       
        $data['user'] = $user;
        return view('frontend.user.address-view',$data); 
    }
    public function addressAdd(){
        $data=[];
        $data['user'] = Auth::user();
        if(isset($_GET['id'])){
            
            $data['address']= Address::find($_GET['id']);
            if($data['address']->address_type == 'Shipping Address' ){
                $data['address_type'] = 'shipping_address';
            }else{
                $data['address_type'] = 'billing_address';
            }
            $pagePath='frontend.user.edit-address';
        }else{
            $pagePath='frontend.user.address';
        }
        
        $data['provinces']= Province::get();
        return view($pagePath,$data); 
    }
    public function addressSave(Request $request){
        
        // if(!isset($request->id) && Address::where('address_type',$request->address_type)->exists()){
        //     return redirect()->back()->withFlashSuccess(__('Address type already exist.'));
        // }

        $data = collect($request->all())->toArray();
        $output = $this->userRepository->saveAddress($data);


        if($output){
            return redirect()->route('frontend.user.address')->withFlashSuccess(__('Address Information Updated'));
        }else{
            return redirect()->back()->withFlashInfo(__('Something went wrong'));
        }
        
    }
    public function payment(){
        $user = Auth::user();
        $data['payments']= PaymentMethod::where('user_id',$user->id)->get();
        $data['user'] = $user;
        return view('frontend.user.payment-view',$data); 
    }
    public function paymentAdd(){
        
        return view('frontend.user.payment'); 
    }
    public function paymentSave(Request $request){
        
        $data = collect($request->all())->toArray();
       
        if (empty($request->card_number) || empty($request->expiry_month) || empty($request->expiry_year) || empty($request->cvc) || empty($request->postal_code)) {
            return redirect()->back()->withFlashInfo(__('Card fields are required.'));
        }
        
        try{
            $output = $this->userRepository->savePayment($data);
            if($output){
                return redirect()->route('frontend.user.payment')->withFlashSuccess(__('Payment Information Updated'));
            }else{
                return redirect()->back()->withFlashInfo(__('Something went wrong'));
            }
        }catch(Exception $e){
            return redirect()->back()->withFlashInfo(__($e->getMessage()));
        }
        
    }
    public function personalDetails(){
        $data['user'] = Auth::user();
        if(isset($_GET['id'])){

            $pathView = 'frontend.user.edit-personal';

        }else{
            $pathView = 'frontend.user.personal';
        }
        
        return view($pathView,$data); 
    }
    public function addressDelete(Request $request){
        $data = collect($request->all())->toArray();
        $output = $this->userRepository->deleteAddress($data);
        if($output){
            $success = true;
        }else{
            $success = false;
        }

        return array('success'=>$success,'message'=>'');
        
    }
    public function addressDefaultChange(Request $request){
        $data = collect($request->all())->toArray();
        $output = $this->userRepository->addressDefaultChange($data);
        if($output){
            $success = true;
        }else{
            $success = false;
        }
        return array('success'=>$success,'message'=>'');
        
    }
    public function paymentDefaultChange(Request $request){
        $data = collect($request->all())->toArray();
        $output = $this->userRepository->paymentDefaultChange($data);
        if($output){
            $success = true;
        }else{
            $success = false;
        }
        return array('success'=>$success,'message'=>'');
        
    }
    public function paymentDelete(Request $request){
        $data = collect($request->all())->toArray();
        $output = $this->userRepository->deletePayment($data);
        if($output){
            $success = true;
        }else{
            $success = false;
        }

        return array('success'=>$success,'message'=>'');
        
    }

    public function insuranceDelete(Request $request){
        $data = collect($request->all())->toArray();
        $output = $this->userRepository->insuranceDelete($data);
        if($output){
            $success = true;
        }else{
            $success = false;
        }

        return array('success'=>$success,'message'=>'');
        
    }

    public function healthCardDelete(Request $request){
        $data = collect($request->all())->toArray();
        $output = $this->userRepository->healthCardDelete($data);
        if($output){
            $success = true;
        }else{
            $success = false;
        }

        return array('success'=>$success,'message'=>'');
        
    }


    public function drugSearch()
    {
        $data['alldrugs'] = Drug::paginate(10); 
        
       return view('frontend.user.medications.search-medication',$data); 
    }

    public function drugSingleDetails(Request $request,$slug)
    {
        
        $data['drug'] = Drug::where('slug',$slug)->first(); 
        return view('frontend.user.medications.single-medication',$data); 
    }

    public function drugAjaxSearch(Request $request){
        $data = collect($request->all())->toArray();
        $output = $this->userRepository->drugAjaxSearch($data);
      
        return $output;
        
    }
    public function searchPharma()
    {
        $user = Auth::user();
        $data['transfer_request'] = TransferRequest::where('user_id',$user->id)->get();
        $data['user'] = $user;
        return view('frontend.user.search-pharma',$data); 
    }
    public function addMember()
    {
        $user = Auth::user();
        $data['user'] = $user;
        return view('frontend.user.add-member',$data); 
    }

    public function placeAjaxSearch(Request $request){
        $data = collect($request->all())->toArray();
        $output = $this->userRepository->placeAjaxSearch($data);
        return $output;
        
    }
    public function orderSave(Request $request){
        $data = collect($request->all())->toArray();
        $output = $this->userRepository->createMedicationOrder($data);
      
        if($output){
            return redirect()->route('frontend.user.orders')->withFlashSuccess(__('Order Created Successfully'));
        }else{
            return redirect()->back()->withFlashInfo(__('Something went wrong'));
        }
    }

    public function transferRequest(Request $request){
        $data = collect($request->all())->toArray();
        $output = $this->userRepository->transferRequestSave($data);
        
        if($output){
            return redirect()->back()->withFlashSuccess(__('Thank you for requesting a transfer. <br> A pharmacy team member will contact you with follow up questions soon!'));
        }else{
            return redirect()->back()->withFlashInfo(__('Something went wrong'));
        }
        
    }

    public function transferRequestDelete(Request $request){
        $admin = User::whereHas('roles', function ($subQuery) { 
            $subQuery->where('name', 'Administrator');
        })->first();
        $output = TransferRequest::find($request->id);
        $user =  User::find($output->user_id);
        $data1= 'Transfer request '.$output->transfer_number.' cancelled by '.$user->full_name;
        sendMail('admin',null,$data1,$admin->id,'Transfer Request Cancelled By Patient',null,null);
        $output->status = 'cancelled';

        if($output->save()){
            return redirect()->back()->withFlashSuccess(__('Transfer Request Cancelled Successfully'));
        }else{
            return redirect()->back()->withFlashInfo(__('Something went wrong'));
        }
        
    }
    
    public function addMemberSave(Request $request){
        $data = collect($request->all())->toArray();
        $output = $this->userRepository->addMemberSave($data);
        if($output){
            return redirect()->route('frontend.user.dashboard')->withFlashSuccess(__(' Member created successfully!'));
        }else{
            return redirect()->back()->withFlashInfo(__('Something went wrong'));
        }
    }

    public function user_switch_start( $id ){
        $new_user = User::find( $id );
        Session::put( 'orig_user', Auth::id() );
        Auth::login( $new_user );
        return redirect()->route('frontend.user.dashboard');
    }

    public function sendOtpToGoogleAccount(Request $request)
    {
        $isexist  = Auth::user();

        if(isset($request->mobile_no) && User::where('mobile_no',$request->mobile_no)->exists()){
            return json_encode(['error' => 1, 'message' => 'Mobile number already exists.']);
        }
  
        
        $otp = generateOTP();
        try{
            
        
        if($isexist){
            
            $otp_unverified = UserOtp::where('user_id',$isexist->id)->orderBy('id','desc')->first();
                if($otp_unverified){
                    $createOtp = $otp_unverified;
                    $createOtp->status = 'unverified';
                }else{
                    $createOtp = new UserOtp();
                }
            
            $createOtp->user_id = $isexist->id;
            $createOtp->otp = $otp;
            
            if($otp){
                if(isset($request->mobile_no) && !empty($request->mobile_no)){

                    if($this->sendSms($request,$otp,($request->dialing_code)?$request->dialing_code:'1')){
                        $createOtp->save();
                    }

                    return json_encode(['error' => 0, 'message' => 'Otp Send Successfully','otp'=>'666']);
                    
                }

                return json_encode(['error' => 1, 'message' => 'Check your mobile number']);
              

            }else{
                return json_encode(['error' => 1, 'message' => 'Otp not exists.']);
            }


            }
    }catch(Exception $e){
        //dd($e);
        return json_encode(['error' => 1, 'message' => 'Something went wrong']);
      //  return json_encode(['error' => 1, 'message' => $e]);
    }
    }

    public function send_otp(Request $request)
    {
        $isexist  = Auth::user();
  
        $otp = generateOTP();
        try{
            if(isset($request->user_from) && $request->user_from == 'google'){
                $createOtp = UserOtp::create(['user_id'=>$isexist->id,'status'=>'verified','otp'=>$otp]);
            }
        
      
        //  dd($message);
        if($isexist){
            $otp_verified = UserOtp::where('user_id',$isexist->id)->where('status','verified')->first();
            if($otp_verified){
                $otp_unverified = UserOtp::where('user_id',$isexist->id)->where('status','unverified')->first();
                if(!$otp_unverified){
                    $otp_unverified = new UserOtp();
                }
               
                $otp_unverified->user_id = $isexist->id;
                $otp_unverified->otp = $otp;

                if(isset($request->mobile_no) && !empty($request->mobile_no)){

                    if($this->sendSms($request,$otp,($isexist->dialing_code)?$isexist->dialing_code:'1')){
                        $otp_unverified->save();
                    }

                    return json_encode(['error' => 0, 'message' => 'Otp Send Successfully','otp'=>'5555']);
                    
                }

                if(isset($request->email) && !empty($request->email)){
                    if($otp_unverified->save()){
                        $data1 =  $otp.' use this OTP to confirm your email';
                        sendMail('mail',null,$data1,$isexist->id,'Confirm Email',$request->email);
                    }
                    return json_encode(['error' => 0, 'message' => 'Otp Send Successfully','otp'=>'5555']);

                }
                return json_encode(['error' => 1, 'message' => 'Check your mobile number']);
              

            }


            }else{
                 return json_encode(['error' => 0, 'message' => 'Otp not exists.']);
            }
    }catch(Exception $e){
        //dd($e);
        return json_encode(['error' => 1, 'message' => 'Something went wrong']);
      //  return json_encode(['error' => 1, 'message' => $e]);
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

    public function emailPhoneChange(Request $request)
    {
        $user = Auth::user();
     
        if(isset($request->email) && !empty($request->email)){
            $user->confirmation_code=md5(rand(9,12));
            $user->confirmed=1;
            $user->email = $request->email;
            if($user->save()){
                return redirect()->back()->withFlashSuccess(__('User information updated Successfully!'));
            }

        }
            $user_otp = UserOtp::where('user_id',$user->id)->where('otp',$request->otp)->first();
            if($user_otp){
                $user_otp->status = 'verified';
                if($user_otp->save()){
                    $user->confirmation_code=md5(rand(9,12));
                    $user->confirmed=1;
                    // if(isset($request->email)){
                    //     $user->email = $request->email;
                    // }
                    if(isset($request->mobile_no)){
                        $user->mobile_no = $request->mobile_no;
                        if(isset($request->dialing_code) && isset($request->user_from) && $request->user_from == 'google'){
                            $user->dialing_code = $request->dialing_code;
                        }
                    }
                    $user->save();

                    if(isset($request->user_from) && $request->user_from == 'google'){
                        return json_encode(['error' => 0, 'profile_step'=> 0 ,'message' => 'Mobile number is verifyed']);
                    }else{
                        if($user->mobile_no && $user->dialing_code){
                            $mobile = $user->dialing_code.$user->mobile_no;
                            sendMessage($mobile,'mail','patient_account_created',$data=null);
                        }
                        return redirect()->back()->withFlashSuccess(__('User information updated Successfully!'));
                    }
                }
            }else{
                return redirect()->back()->withFlashInfo(__('Otp not match'));
            }
        
        
        return redirect()->back()->withFlashInfo(__('Something went wrong'));


    }

    

    public function skip_referral(Request $request)
    {
        // print_r($request->all());
        // Get authenticated user
        $user = Auth::user();
        // Update the authenticated user to mark referral as updated
        User::where('id', $user->id)->update(['is_referred_updated' => 'yes']);
        if(Auth::check() && Auth::user()->is_profile_status == "completed" && Auth::user()->is_referred_updated =='yes'){
            return redirect()->route('frontend.user.dashboard');
        }
        return redirect()->back();
    }

    public function accountReferralskiped(){
        // if(Auth::check() && Auth::user()->is_profile_status == "completed" && Auth::user()->is_referred_updated =='yes'){
        //     return redirect()->route('frontend.user.dashboard');
        // }
        $user_refs = UserReferal::with('user')->where('user_id',Auth::user()->id)->first(); 
        return view('frontend.auth.steps.referral')->with(['user_ref'=>$user_refs]);
    }
    
}

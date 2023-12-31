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
        if(Auth::check() && Auth::user()->is_profile_status == "completed"){
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
        if(Auth::check() && Auth::user()->is_profile_status == "completed"){
            return redirect()->route('frontend.user.dashboard');
        }
        return view('frontend.auth.steps.telehealth');
    }
    public function personal(){
        if(Auth::check() && Auth::user()->is_profile_status == "completed"){
            return redirect()->route('frontend.user.dashboard');
        }
        
        return view('frontend.auth.steps.personal');
    }

    public function personal_update(Request $request){


        $output = $this->userRepository->update(
            Auth::user(),
            ['first_name'=>$request->first_name, 'last_name'=>$request->last_name, 'date_of_birth'=>$request->date.'-'.$request->month.'-'.$request->year,'gender'=>$request->gender],
            $request->has('avatar_location') ? $request->file('avatar_location') : false
        );

        if($output){
            return redirect()->back()->withFlashSuccess(__('Information Updated'));
        }else{
            return redirect()->back()->withFlashInfo(__('Something went wrong'));
        }

    }
    public function personal_save(Request $request){



        $output = $this->userRepository->update(
            Auth::user(),
            ['first_name'=>$request->first_name, 'last_name'=>$request->last_name, 'date_of_birth'=>$request->date.'-'.$request->month.'-'.$request->year,'profile_step'=>1],
            $request->has('avatar_location') ? $request->file('avatar_location') : false
        );

        if($output){
            return redirect()->route('frontend.auth.step.almostdone')->withFlashSuccess(__('Information Updated'));
        }else{
            return redirect()->back()->withFlashInfo(__('Something went wrong'));
        }

    }
    public function almostdone(){
        if(Auth::check() && Auth::user()->is_profile_status == "completed"){
            return redirect()->route('frontend.user.dashboard');
        }

        return view('frontend.auth.steps.almostdone');
    }
    public function almostdone_save(Request $request){


        if(isset($request->email) && User::where('email',$request->email)->exists()){
            return redirect()->back()->withFlashInfo(__('      This  email ( '.$request->email.' ) already exists.')); 
        }
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
        if(Auth::check() && Auth::user()->is_profile_status == "completed"){
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
        return view('frontend.auth.steps.profile-completed');
    }


    public function userPrescripiton()
    {
        $user = Auth::user();
        $data['prescriptions'] = Prescription::where('user_id',$user->id)->get();
        //dd($data['prescriptions'][0]);
        //dd('sss');
        return view('frontend.user.prescription',$data); 
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
    public function userPrescripitonRefill($id){

        $prescription = Prescription::find($id);
        $user = Auth::user();
        $prescriptionRefill = new PrescriptionRefill();
        $prescriptionRefill->prescription_id =  $id;
        $prescriptionRefill->user_id =  $user->id;
        $prescriptionRefill->status =  'pending';
        
        if($prescriptionRefill->save()){
            
            if(isset($user->parent_id) && !empty($user->parent_id)){ 
                $parient_name = $user->full_name;
                $user = User::where('id',$user->parent_id)->first(); 
                
            }
            $data =  'Hello MisterPharmacist team!'."\n\n ".$user->full_name.' - '.$user->date_of_birth.' - '.$user->mobile_no.' - '.$user->email.' Is requesting a refill for the above indicated medication"

            '."\n\n".' Please review the patient pharmacy record and determine if the medication can be refilled or the patient healthcare provider needs to be contacted to reissue the refill-   
            
            '."\n\n".' Please use your professional judgement and contact the patient to inform of the appropriate next steps"';
          
            $data_u =$user->full_name;
            // send messages to users
            $mobile = $user->dialing_code.$user->mobile_no;
            sendMessage($mobile,'mail','prescription_refill_created',$data_u);
            if(isset($user->email)){
                sendMail('mail','prescription_refill_created',$data_u,$user->id);
            }

            //send messages to admin
            $admin = User::whereHas('roles', function ($subQuery) { 
                            $subQuery->where('name', 'Administrator');
                        })->first();
            $adminmobile = $admin->dialing_code.$admin->mobile_no;
                    sendMessage($adminmobile,'admin',null,$data);
                    if(isset($admin->email)){
                        sendMail('admin',null,$data,$admin->id);
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
        $data['orders']= Order::where('user_id',$user->id)->with(['prescription','order_items','order_items.medication','order_items.medication.prescription'])->has('order_items')->get();
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
        $data['address']= Address::where('user_id',$user->id)->get();
       
        $data['user'] = $user;
        return view('frontend.user.address-view',$data); 
    }
    public function addressAdd(){
        $data=[];
        $data['user'] = Auth::user();
        if(isset($_GET['id'])){
            
            $data['address']= Address::find($_GET['id']);
        }
        $data['provinces']= Province::get();
        return view('frontend.user.address',$data); 
    }
    public function addressSave(Request $request){
        
        if(!isset($request->id) && Address::where('address_type',$request->address_type)->exists()){
            return redirect()->back()->withFlashSuccess(__('Address type already exist.'));
        }

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
        $output = $this->userRepository->savePayment($data);
        if($output){
            return redirect()->route('frontend.user.payment')->withFlashSuccess(__('Payment Information Updated'));
        }else{
            return redirect()->back()->withFlashInfo(__('Something went wrong'));
        }
        
    }
    public function personalDetails(){
        $data['user'] = Auth::user();
        return view('frontend.user.personal',$data); 
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
            return redirect()->back()->withFlashSuccess(__('Order Created Successfully'));
        }else{
            return redirect()->back()->withFlashInfo(__('Something went wrong'));
        }
    }

    public function transferRequest(Request $request){
        $data = collect($request->all())->toArray();
        $output = $this->userRepository->transferRequestSave($data);
        
        if($output){
            return redirect()->back()->withFlashSuccess(__('Transfer Request Created Successfully'));
        }else{
            return redirect()->back()->withFlashInfo(__('Something went wrong'));
        }
        
    }

    public function transferRequestDelete(Request $request){
        
        $output = TransferRequest::find($request->id);
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
            return redirect()->back()->withFlashSuccess(__('Add Member Created Successfully!'));
        }else{
            return redirect()->back()->withFlashInfo(__('Something went wrong'));
        }
        
    }
    public function user_switch_start( $id ){
        $new_user = User::find( $id );
        Session::put( 'orig_user', Auth::id() );
        Auth::login( $new_user );
        return redirect()->back();
    }
    
}

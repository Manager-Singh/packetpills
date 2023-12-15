<?php

namespace App\Repositories\Backend\Auth;

use App\Events\Backend\Auth\User\UserConfirmed;
use App\Events\Backend\Auth\User\UserCreated;
use App\Events\Backend\Auth\User\UserDeactivated;
use App\Events\Backend\Auth\User\UserDeleted;
use App\Events\Backend\Auth\User\UserPasswordChanged;
use App\Events\Backend\Auth\User\UserPermanentlyDeleted;
use App\Events\Backend\Auth\User\UserReactivated;
use App\Events\Backend\Auth\User\UserRestored;
use App\Events\Backend\Auth\User\UserUnconfirmed;
use App\Events\Backend\Auth\User\UserUpdated;
use App\Exceptions\GeneralException;
use App\Models\Auth\User;
use App\Notifications\Backend\Auth\UserAccountActive;
use App\Notifications\Frontend\Auth\UserNeedsConfirmation;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use App\Models\Prescription;
use App\Models\HealthCard;
use App\Models\PrescriptionIteam;
use App\Models\Address;
use App\Models\TransferRequest;
use App\Models\HealthInformation;
use App\Models\PaymentMethod;
use App\Models\Insurance;
use App\Models\MedicationItem;
use App\Models\Order;
use App\Models\OrderItem;
use File;
use Ramsey\Uuid\Uuid;
use App\Models\PrescriptionRefill;




/**
 * Class UserRepository.
 */
class UserRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = User::class;

    /**
     * @param int  $status
     * @param bool $trashed
     *
     * @return mixed
     */
    public function getForDataTable($status = 1, $trashed = false, $type = false, $uid= false)
    {
        /**
         * Note: You must return deleted_at or the User getActionButtonsAttribute won't
         * be able to differentiate what buttons to show for each row.
         */
        $dataTableQuery = $this->query()
            ->select([
                'users.id',
                'users.first_name',
                'users.last_name',
                'users.email',
                'users.status',
                'users.confirmed',
                'users.created_at',
                'users.updated_at',
                'users.deleted_at',
            ]);
        
            if($type == 'members' && $uid){
                //dd($uid);
                $dataTableQuery->where('parent_id','=',$uid);

            }else{
                $dataTableQuery->where('parent_id','=',null);
            }

        if ($trashed == 'true') {
            return $dataTableQuery->onlyTrashed();
        }

        // active() is a scope on the UserScope trait
        return $dataTableQuery->active($status);
    }

    /**
     * @param array $data
     *
     * @throws \Exception
     * @throws \Throwable
     * @return User
     */
    
    public function delete_address($id)
    {
        return DB::transaction(function () use ($id) {
            $address = Address::where('id',$id)->first();
           
                if ($address->forceDelete()) {
               
                    return $id;
                }
           
            
            throw new GeneralException(__('Problem With Delete Address.'));
           });
    }
    
    public function delete_payment_method($id)
    {
        return DB::transaction(function () use ($id) {
            $pmethod = PaymentMethod::where('id',$id)->first();
           
                if ($pmethod->forceDelete()) {
               
                    return $id;
                }
           
            
            throw new GeneralException(__('Problem With Delete Address.'));
           });
    }
    

    public function paymentmethod(array $data,$files)
    {
        $user_id = $data['user_id'];
       
        return DB::transaction(function () use ($data,$user_id,$files) {
            PaymentMethod::where('user_id',$user_id)->update(array('default' => 'no'));

            $creditCardImages = [];
            if(isset($files)){
                if(count($files)>0){
                   
                        // die;
                        $page_no = 1;
                        foreach ($files as $key => $image) {
                            $uuid = Uuid::uuid4()->toString();
                            $fileName   = $uuid . '.' . $image->getClientOriginalExtension();
                            $destinationPath = public_path('img/frontend/credit-card');
                            $image->move($destinationPath, $fileName);
                            $front_url = 'img/frontend/credit-card/'.$fileName;
                            array_push($creditCardImages,$front_url);
                        }
                    }
                
                }
            $payment_method = new PaymentMethod;
            $payment_method->user_id = $user_id;
            $payment_method->card_number = $data['card_number'];
            $payment_method->cardholder_name = $data['cardholder_name'];
            $expiry_date = $data['expiry_month'].'/'.$data['expiry_year'];
            $payment_method->expiry_date = $expiry_date;
            $payment_method->cvc = $data['cvc'];
            if(isset($creditCardImages[0])){
                $payment_method->front_img = $creditCardImages[0];
            }
            if(isset($creditCardImages[1])){
                $payment_method->back_img = $creditCardImages[1];
            }
            $payment_method->default = 'yes';
            if($payment_method->save()){
                $user = User::where('id',$user_id)->first();

                if(isset($user->parent_id) && !empty($user->parent_id)){ 
                    $data =  ' to '.$user->full_name;
                    $user = User::where('id',$user->parent_id)->first(); 
                    $user_id = $user->id;
                }else{
                    $data =  "";
                    
                }


                if($user->mobile_no && $user->dialing_code){
                    $mobile = $user->dialing_code.$user->mobile_no;
                    sendMessage($mobile,'mail','payment_method_created',$data);
                    if(isset($user->email)){
                        sendMail('mail','payment_method_created',$data,$user_id);
                    }

                }
                return true;
            }
            
            throw new GeneralException(__('Problem With Update Payment Method.'));
           });
    }
    public function edit_paymentmethod(array $data,$files)
    {
        $user_id = $data['user_id'];
        $payment_method_id = $data['payment_method_id'];
       
        return DB::transaction(function () use ($data,$user_id,$payment_method_id,$files) {
            PaymentMethod::where('user_id',$user_id)->update(array('default' => 'no'));
            $payment_method = PaymentMethod::where('id',$payment_method_id)->first();

            $creditCardImages = [];
            if(isset($files)){

                if(count($files)>0){
                    if(count($files)==1){
                        $front_img = $payment_method->front_img;
                        if(File::exists($front_img)) {
                            File::delete($front_img);
                        }
                    }else{
                        $front_img = $payment_method->front_img;
                        if(File::exists($front_img)) {
                            File::delete($front_img);
                        }
                        $back_img = $payment_method->back_img;
                        if(File::exists($back_img)) {
                            File::delete($back_img);
                        }

                    }
                   
                        // die;
                        $page_no = 1;
                        foreach ($files as $key => $image) {
                            $uuid = Uuid::uuid4()->toString();
                            $fileName   = $uuid . '.' . $image->getClientOriginalExtension();
                            $destinationPath = public_path('img/frontend/credit-card');
                            $image->move($destinationPath, $fileName);
                            $front_url = 'img/frontend/credit-card/'.$fileName;
                            array_push($creditCardImages,$front_url);
                        }
                    }
                
                }
            $payment_method->user_id = $user_id;
            $payment_method->card_number = $data['card_number'];
            $payment_method->cardholder_name = $data['cardholder_name'];
            $expiry_date = $data['expiry_month'].'/'.$data['expiry_year'];
            $payment_method->expiry_date = $expiry_date;
            $payment_method->cvc = $data['cvc'];
            if(isset($creditCardImages[0])){
                $payment_method->front_img = $creditCardImages[0];
            }
            if(isset($creditCardImages[1])){
                $payment_method->back_img = $creditCardImages[1];
            }
            $payment_method->default = 'yes';
            if($payment_method->save()){
                $user = User::where('id',$user_id)->first();
                if(isset($user->parent_id) && !empty($user->parent_id)){ 
                    $data =  ' to '.$user->full_name;
                    $user = User::where('id',$user->parent_id)->first(); 
                    $user_id = $user->id;
                }else{
                    $data =  "";
                    
                }

                if($user->mobile_no && $user->dialing_code){
                    $mobile = $user->dialing_code.$user->mobile_no;
                    // print_r($mobile);
                    // die;
                    //$data =  "Your Prescription no is ".$prescription->prescription_number;
                    sendMessage($mobile,'mail','payment_method_updated',$data);
                    if(isset($user->email)){
                        sendMail('mail','payment_method_updated',$data,$user_id);
                    }
                }
                return true;
            }
            
            throw new GeneralException(__('Problem With Update Payment Method.'));
           });
    }
    public function create_address(array $data)
    {
        $user_id = $data['user_id'];
       
        return DB::transaction(function () use ($data,$user_id) {
            Address::where('user_id',$user_id)->update(array('mark_as' => 'normal'));
            $address = new Address;
            $address->user_id = $user_id;
            $address->address1 = $data['address1'];
            $address->address2 = $data['address2'];
            $address->postal_code = $data['postal_code'];
            $address->city = $data['city'];
            $address->province = $data['province'];
            $address->mark_as = 'default';
            $address->address_type = $data['address_type'];
            $address->is_verify = 1;
            if($address->save()){
                $user = User::where('id',$user_id)->first();

                if(isset($user->parent_id) && !empty($user->parent_id)){ 
                    $data =  ' to '.$user->full_name;
                    $user = User::where('id',$user->parent_id)->first(); 
                    $user_id = $user->id;
                }else{
                    $data =  "";
                    
                }

                if($user->mobile_no && $user->dialing_code){
                    $mobile = $user->dialing_code.$user->mobile_no;
                    // print_r($mobile);
                    // die;
                    //$data =  "Your Prescription no is ".$prescription->prescription_number;
                    sendMessage($mobile,'mail','address_created',$data);
                    if(isset($user->email)){
                        sendMail('mail','address_created',$data,$user_id);
                    }
                }
                return true;
            }
            
            throw new GeneralException(__('Problem With create Address.'));
           });
    }

    public function edit_address(array $data)
    {
    //    print_r($data);
    //    die;
        $user_id = $data['user_id'];
        $address_id = $data['address_id'];
       
        return DB::transaction(function () use ($data,$user_id,$address_id) {
           Address::where('user_id',$user_id)->update(array('mark_as' => 'normal'));
           
            $address =  Address::where('id',$address_id)->first();
            $address->user_id = $user_id;
            $address->address1 = $data['address1'];
            $address->address2 = $data['address2'];
            $address->postal_code = $data['postal_code'];
            $address->city = $data['city'];
            $address->province = $data['province'];
            $address->mark_as = 'default';
            $address->address_type = $data['address_type'];
            $address->is_verify = 1;
            if($address->save()){
                $user = User::where('id',$user_id)->first();

                if(isset($user->parent_id) && !empty($user->parent_id)){ 
                    $data =  ' to '.$user->full_name;
                    $user = User::where('id',$user->parent_id)->first(); 
                    $user_id = $user->id;
                }else{
                    $data =  "";
                    
                }


                if($user->mobile_no && $user->dialing_code){
                    $mobile = $user->dialing_code.$user->mobile_no;
                    // print_r($mobile);
                    // die;
                    //$data =  "Your Prescription no is ".$prescription->prescription_number;
                    sendMessage($mobile,'mail','address_updated',$data);
                    if(isset($user->email)){
                        sendMail('mail','address_updated',$data,$user_id);
                    }
                }
                return true;
            }
            
            throw new GeneralException(__('Problem With create Address.'));
           });
    }
    
    public function create_healthcard(array $data,$files)
    {
        $user_id = $data['user_id'];
        $healthcard_number = $data['healthcard_number'];

        return DB::transaction(function () use ($user_id,$healthcard_number,$files,$data) {
            $healthCardImages = [];
            if(isset($files)){
                if(count($files)>0){
                   
                        // die;
                        $page_no = 1;
                        foreach ($files as $key => $image) {
                            $uuid = Uuid::uuid4()->toString();
                            $fileName   = $uuid . '.' . $image->getClientOriginalExtension();
                            $destinationPath = public_path('img/frontend/health-card');
                            $image->move($destinationPath, $fileName);
                            $front_url = 'img/frontend/health-card/'.$fileName;
                            array_push($healthCardImages,$front_url);
                        }
                    }
                
                }
            $healthCard = HealthCard::where('user_id',$user_id)->first();
            $hc = 1;
            if ($healthCard === null) {
                $healthCard  = new HealthCard;
                $healthCard->user_id = $user_id;
                $hc = 2;
             }
            $healthCard->front_img = (isset($healthCardImages[0])) ? $healthCardImages[0] : '';
            if(isset($healthCardImages[1])){
                $healthCard->back_img = $healthCardImages[1];
            }
            
            $healthCard->is_verify = 1;
            $healthCard->card_number = $healthcard_number;
            $healthCard->odsp = null;
            $healthCard->trillium_program = null;
            $healthCard->ohip = null;
            if(isset($data['odsp']) && !empty($data['odsp'])){
                $healthCard->odsp = $data['odsp'];
            }
            if(isset($data['trillium_program']) && !empty($data['trillium_program'])){
                $healthCard->trillium_program = $data['trillium_program'];
            }
            if(isset($data['ohip']) && !empty($data['ohip'])){
                $healthCard->ohip = $data['ohip'];
            }
            if($healthCard->save()){
                $user = User::where('id',$user_id)->first();

                if(isset($user->parent_id) && !empty($user->parent_id)){ 
                    $data =  ' to '.$user->full_name;
                    $user = User::where('id',$user->parent_id)->first(); 
                    $user_id = $user->id;
                }else{
                    $data =  "";
                    
                }

                if($user->mobile_no && $user->dialing_code){
                    $mobile = $user->dialing_code.$user->mobile_no;
                    // print_r($mobile);
                    // die;
                    //$data =  "Your Prescription no is ".$prescription->prescription_number;
                    if($hc=1){
                        sendMessage($mobile,'mail','healthcard_updated',$data);
                        if(isset($user->email)){
                            sendMail('mail','healthcard_updated',$data,$user_id);
                        }
                    }else{
                        sendMessage($mobile,'mail','healthcard_created',$data);
                        if(isset($user->email)){
                            sendMail('mail','healthcard_created',$data,$user_id);
                        }
                    }
                    
                }
                return true;
            }
           
          
    
            
            throw new GeneralException(__('Problem With create Health Card.'));
           });
    }

    


    public function create_insurance(array $data,$files)
    {
        $user_id = $data['user_id'];
        $type = $data['type'];
        return DB::transaction(function () use ($user_id,$type,$files) {
            $insurance = Insurance::where('user_id',$user_id)->where('type',$type)->first();

            $insuranceImages = [];
            if(isset($files)){
                if(count($files)>0){
                    if($insurance){
                    if(count($files)==1){
                        $front_img = $insurance->front_img;
                        if(File::exists($front_img)) {
                            File::delete($front_img);
                        }
                    }else{
                        $front_img = $insurance->front_img;
                        if(File::exists($front_img)) {
                            File::delete($front_img);
                        }
                        $back_img = $insurance->back_img;
                        if(File::exists($back_img)) {
                            File::delete($back_img);
                        }

                    }
                }
                        $page_no = 1;
                        foreach ($files as $key => $image) {
                            $uuid = Uuid::uuid4()->toString();
                            $fileName   = $uuid . '.' . $image->getClientOriginalExtension();
                            $destinationPath = public_path('img/frontend/insurance');
                            $image->move($destinationPath, $fileName);
                            $front_url = 'img/frontend/insurance/'.$fileName;
                            array_push($insuranceImages,$front_url);
                        }
                    }
                
                }
            //$healthCard = HealthCard::where('user_id',$user_id)->first();
            $insu =1;
            if ($insurance === null) {
                $insurance  = new Insurance;
                $insurance->user_id = $user_id;
                $insurance->type = $type;
                $insu =2;
             }
             if(isset($insuranceImages[0])){
                $insurance->front_img = $insuranceImages[0];
            }
            if(isset($insuranceImages[1])){
                $insurance->back_img = $insuranceImages[1];
            }
            $insurance->is_verify = 1;
            if($insurance->save()){
                $user = User::where('id',$user_id)->first();

                if(isset($user->parent_id) && !empty($user->parent_id)){ 
                    $data =  ' to '.$user->full_name;
                    $user = User::where('id',$user->parent_id)->first(); 
                    $user_id = $user->id;
                }else{
                    $data =  null;
                    
                }

                if($user->mobile_no && $user->dialing_code){
                    $mobile = $user->dialing_code.$user->mobile_no;
                    // print_r($mobile);
                    // die;
                    //$data =  "Your Prescription no is ".$prescription->prescription_number;
                    if($insu=1){
                        sendMessage($mobile,'mail','insurance_updated',$data);
                        if(isset($user->email)){
                            sendMail('mail','insurance_updated',$data,$user_id);
                        }
                    }else{
                        sendMessage($mobile,'mail','insurance_created',$data);
                        if(isset($user->email)){
                            sendMail('mail','insurance_created',$data,$user_id);
                        }
                    }
                }
                return true;
            }
           
          
    
            
            throw new GeneralException(__('Problem With create Insurance.'));
           });
    }
    

    public function healthinformation(array $data)
    {
        $user_id = $data['user_id'];
        return DB::transaction(function () use ($user_id,$data) {
         
         
            $HealthInformation = HealthInformation::where('user_id',$user_id)->first();
            $Hi=1;
            if ($HealthInformation === null) {
                $HealthInformation  = new HealthInformation;
                $HealthInformation->user_id = $user_id;
                $Hi=2;
             }
            $HealthInformation->allergies = $data['allergies'];
            $HealthInformation->supplements_medications = $data['supplements_medications'];
            if($data['allergies']==1){
                $HealthInformation->allergies_medications = $data['allergies_medications'];
            }else{
                $HealthInformation->allergies_medications = null;
            }
            if($HealthInformation->save()){
                $user = User::where('id',$user_id)->first();

                if(isset($user->parent_id) && !empty($user->parent_id)){ 
                    $data =  ' to '.$user->full_name;
                    $user = User::where('id',$user->parent_id)->first(); 
                    $user_id = $user->id;
                }else{
                    $data =  null;
                    
                }



                if($user->mobile_no && $user->dialing_code){
                    $mobile = $user->dialing_code.$user->mobile_no;
                    // print_r($mobile);
                    // die;
                    //$data =  "Your Prescription no is ".$prescription->prescription_number;
                    if($Hi=1){
                        sendMessage($mobile,'mail','healthinformation_updated',$data);
                        if(isset($user->email)){
                            sendMail('mail','healthinformation_updated',$data,$user_id);
                        }
                    }else{
                        sendMessage($mobile,'mail','healthinformation_created',$data);
                        if(isset($user->email)){
                            sendMail('mail','healthinformation_created',$data,$user_id);
                        }
                    }
                }
                return true;
            }
           
          
    
            
            throw new GeneralException(__('Problem With Upadate Health Information.'));
           });
    }
    public function create_prescription(array $data,$files)
    {
        $user_id = $data['user_id'];
        $user = User::where('id',$user_id)->first();
        return DB::transaction(function () use ($user_id,$files, $user) {
            if(isset($files)){
                if(count($files)>0){
                    $prescription = new Prescription;
                    $prescription->prescription_number = Prescription::generatePrescriptionNumber();
                    $prescription->user_id = $user_id;
                    if($prescription->save()){
                        $page_no = 1;
                        foreach ($files as $key => $image) {
                            $uuid = Uuid::uuid4()->toString();
                            $prescriptionIteam = new PrescriptionIteam;
                            $fileName   = $uuid . '.' . $image->getClientOriginalExtension();
                            $destinationPath = public_path('img/frontend/prescription');
                            $image->move($destinationPath, $fileName);
                            $front_url = 'img/frontend/prescription/'.$fileName;
                            $prescriptionIteam->page_no = $page_no;
                            $prescriptionIteam->prescription_upload = $front_url;
                            $prescriptionIteam->prescripiton_id = $prescription->id;
                            $prescriptionIteam->save();
                            $page_no++;
                        }
                        if(isset($user->parent_id) && !empty($user->parent_id)){ 
                            $data =  "Your Prescription no is ".$prescription->prescription_number.' & created to '.$user->full_name;
                            $user = User::where('id',$user->parent_id)->first(); 
                            $user_id = $user->id;
                        }else{
                            $data =  "Your Prescription no is ".$prescription->prescription_number;
                            
                        }
                        if($user->mobile_no && $user->dialing_code){
                            $mobile = $user->dialing_code.$user->mobile_no;
                            //$data =  "Your Prescription no is ".$prescription->prescription_number;
                            sendMessage($mobile,'mail','patient_prescription_created',$data);
                            if(isset($user->email)){
                                sendMail('mail','patient_prescription_created',$data,$user_id);
                            }
                        }
                        return true;
                    }
                
                }
    
            }
            
            
         throw new GeneralException(__('Problem With Create prescription.'));
        });
    }

    
    public function create_medication(array $data)
    {
        return DB::transaction(function () use ($data) {
            
          $t = 0;
                foreach($data['drug'] as $key => $drug){
                    $medicationItem = new MedicationItem;
                    $medicationItem->drug_name = $drug;
                    $medicationItem->price = $data['price'][$key];
                    $medicationItem->prescribing_doctor = $data['prescribing_doctor'];
                    $medicationItem->prescription_id = $data['prescription_id'];
                    $medicationItem->user_id = $data['user_id'];
                    $medicationItem->created_by = access()->user()->id;
                    $medicationItem->save();
                    $t=1;
                }
                
                
                if($t==1){
                    $user = User::where('id',$data['user_id'])->first();

                    if(isset($user->parent_id) && !empty($user->parent_id)){ 
                        $data =  "Your Prescription no is ".getPrescriptionData($data['prescription_id'])->prescription_number.' & created to '.$user->full_name;
                        $user = User::where('id',$user->parent_id)->first(); 
                   }else{
                    $data =  "Your Prescription no is ".getPrescriptionData($data['prescription_id'])->prescription_number;
                        
                    }

                    if($user->mobile_no && $user->dialing_code){
                        $mobile = $user->dialing_code.$user->mobile_no;
                        // print_r($mobile);
                        // die;
                        
                            sendMessage($mobile,'mail','patient_medication_created',$data);
                            if(isset($user->email)){
                                sendMail('mail','patient_medication_created',$data,$user->id);
                            }
                         
    
                    }
                }
                return true;
         
       
        
            
        throw new GeneralException(__('Problem With Create Medication.'));
       });
    }

    public function createMedicationOrder(array $data)
    {
       
        return DB::transaction(function () use ($data) {
           // $data['medication'];
            $order = new Order;
            $order->order_number = Order::generateOrderNumber();
            $order->prescription_id = $data['prescription_id'];
            $order->user_id = $data['user_id'];
            $order->total_amount = getTotalAmount($data['medication']);
            $order->created_by = access()->user()->id;
            if($order->save()){
                foreach($data['medication'] as $key => $medication){
                    $order_item = new OrderItem;       
                    $order_item->order_id = $order->id;
                    $order_item->medication_id = $medication;
                    $order_item->price = getPrice($medication);
                    $order_item->save();
                }
                $user = User::where('id',$order->user_id)->first();

                if(isset($user->parent_id) && !empty($user->parent_id)){ 
                    $data =  "Your Order no is ".$order->order_number.'. and Total amount is $'.$order->total_amount.' & created to '.$user->full_name;
                    $user = User::where('id',$user->parent_id)->first(); 
               }else{
                    $data =  "Your Order no is ".$order->order_number.'. and Total amount is $'.$order->total_amount;   
                }

                if($user->mobile_no && $user->dialing_code){
                    $mobile = $user->dialing_code.$user->mobile_no;
                    // print_r($mobile);
                    // die;
                    //$data =  "Your Order no is ".$order->order_number.'. and Total amount is $'.$order->total_amount;
                        sendMessage($mobile,'mail','patient_order_created',$data);
                        if(isset($user->email)){
                            sendMail('mail','patient_order_created',$data,$user->id);
                        }
                }
                
                return 1;
            }
          
        throw new GeneralException(__('Problem With Create Medication.'));
       });
    }
    public function create(array $data,$files,$iprofile_mage=false)
    {
        // print_r($files);
        // die;
        $roles = $data['assignees_roles'];
        $permissions = $data['permissions'];
        // $permissions = $data['files'];

        unset($data['assignees_roles']);
        unset($data['permissions']);

        $user = $this->createUserStub($data);

        return DB::transaction(function () use ($user, $data, $roles, $permissions,$files,$iprofile_mage) {
          
            if ($user->save()) {
                //Attach new roles
                $user->attachRoles($roles);

                // Attach New Permissions
                $user->attachPermissions($permissions);

                //Send confirmation email if requested and account approval is off
                if (isset($data['confirmation_email']) && $user->confirmed == 0) {
                    $user->notify(new UserNeedsConfirmation($user->confirmation_code));
                }
               
                if($iprofile_mage){
                    $nuuid = Uuid::uuid4()->toString();
                    $fileNamen   = $nuuid . '.' . $iprofile_mage->getClientOriginalExtension();
                    $destinationPathn = public_path('img/frontend/avatar');
                    $iprofile_mage->move($destinationPathn, $fileNamen);
                    $front_urln = 'img/frontend/avatar/'.$fileNamen;
                    $user->avatar_type = 'upload';
                    $user->avatar_location = $front_urln;
                    $user->save();
                }
                event(new UserCreated($user));
               
                    if(isset($files)){
                        if(count($files)>0){
                            $prescription = new Prescription;
                            $prescription->prescription_number = Prescription::generatePrescriptionNumber();
                            $prescription->user_id = $user->id;
                            // $prescription->prescription_type_id
                            if($prescription->save()){
                                // print_r($prescription);
                                // die;
                                $page_no = 1;
                                foreach ($files as $key => $image) {
                                    $uuid = Uuid::uuid4()->toString();
                                    $prescriptionIteam = new PrescriptionIteam;
                                    $fileName   = $uuid . '.' . $image->getClientOriginalExtension();
                                    $destinationPath = public_path('img/frontend/prescription');
                                    $image->move($destinationPath, $fileName);
                                    $front_url = 'img/frontend/prescription/'.$fileName;
                                    $prescriptionIteam->page_no = $page_no;
                                    $prescriptionIteam->prescription_upload = $front_url;
                                    $prescriptionIteam->prescripiton_id = $prescription->id;
                                    $prescriptionIteam->save();
                                    $page_no++;
                                }
                            }
                        
                    }
               
        }

                return $user;
            }

            throw new GeneralException(__('exceptions.backend.access.users.create_error'));
        });
    }

    /**
     * @param \App\Models\Auth\User  $user
     * @param array $data
     *
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     * @return \App\Models\Auth\User
     */
    public function update(User $user, array $data,$iprofile_mage=false)
    {

        $roles = $data['assignees_roles'];
        $permissions = $data['permissions'];

        unset($data['assignees_roles']);
        unset($data['permissions']);

        return DB::transaction(function () use ($user, $data, $roles, $permissions,$iprofile_mage) {
          
            $user->mobile_no = $data['mobile_no'];
            $user->status = isset($data['status']) && $data['status'] == '1' ? 1 : 0;
            $user->confirmed = isset($data['confirmed']) && $data['confirmed'] == '1' ? 1 : 0;
            $user->gender = isset($data['gender']) ? $data['gender'] : null;
            $user->date_of_birth = isset($data['date_of_birth']) ? $data['date_of_birth'] : null;
            $user->province = isset($data['province']) ? $data['province'] : null;

            // print_r( $iprofile_mage);
            // die;
          
//   print_r($data);
//             die;
            if ($user->update($data)) {
                $user->roles()->sync($roles);
                $user->permissions()->sync($permissions);
               $nuser = User::where('id',$user->id)->first();

               if($iprofile_mage){
                    $nuuid = Uuid::uuid4()->toString();
                    $fileName   = $nuuid . '.' . $iprofile_mage->getClientOriginalExtension();
                    $destinationPath = public_path('img/frontend/avatar');
                    $iprofile_mage->move($destinationPath, $fileName);
                    $front_url = 'img/frontend/avatar/'.$fileName;
                    $nuser->avatar_type = 'upload';
                    $nuser->avatar_location = $front_url;
                    $nuser->save();
                //      print_r( $front_url);
                // die;
                    
                }
                if(isset($user->parent_id) && !empty($user->parent_id)){ 
                    $data =  ' to '.$user->full_name;
                    $user = User::where('id',$user->parent_id)->first(); 
                    $user_id = $user->id;
                }else{
                    $data =  null;
                    
                }

                if($user->mobile_no && $user->dialing_code){
                    $mobile = $user->dialing_code.$user->mobile_no;
                    // print_r($mobile);
                    // die;
                    sendMessage($mobile,'mail','patient_account_updated',$data);
                    if(isset($user->email)){
                        sendMail('mail','patient_account_updated',$data,$user->id);
                    }
                }
               
                event(new UserUpdated($user));
                return $user;
            }

            throw new GeneralException(__('exceptions.backend.access.users.update_error'));
        });
    }

    /**
     * Delete User.
     *
     * @param App\Models\Auth\User $user
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(User $user)
    {
        if (access()->id() == $user->id) {
            throw new GeneralException(__('exceptions.backend.access.users.cant_delete_self'));
        }

        if ($user->delete()) {
            event(new UserDeleted($user));

            return true;
        }

        throw new GeneralException(__('exceptions.backend.access.users.delete_error'));
    }

    /**
     * @param \App\Models\Auth\User $user
     * @param      $input
     *
     * @throws GeneralException
     * @return \App\Models\Auth\User
     */
    public function updatePassword(User $user, $input): User
    {
        if ($user->update(['password' => bcrypt($input['password'])])) {
            event(new UserPasswordChanged($user));

            return $user;
        }

        throw new GeneralException(__('exceptions.backend.access.users.update_password_error'));
    }

    /**
     * @param \App\Models\Auth\User $user
     * @param int $status
     *
     * @throws GeneralException
     * @return \App\Models\Auth\User
     */
    public function mark(User $user, $status): User
    {
        if (access()->id() == $user->id && $status == 0) {
            throw new GeneralException(__('exceptions.backend.access.users.cant_deactivate_self'));
        }

        $user->status = $status;

        switch ($status) {
            case 0:
                event(new UserDeactivated($user));
                break;
            case 1:
                event(new UserReactivated($user));
                break;
        }

        if ($user->save()) {
            return $user;
        }

        throw new GeneralException(__('exceptions.backend.access.users.mark_error'));
    }

    /**
     * @param \App\Models\Auth\User $user
     *
     * @throws GeneralException
     * @return \App\Models\Auth\User
     */
    public function confirm(User $user): User
    {
        if ($user->confirmed) {
            throw new GeneralException(__('exceptions.backend.access.users.already_confirmed'));
        }

        $user->confirmed = true;
        $confirmed = $user->save();

        if ($confirmed) {
            event(new UserConfirmed($user));

            // Let user know their account was approved
            if (config('access.users.requires_approval')) {
                $user->notify(new UserAccountActive);
            }

            return $user;
        }

        throw new GeneralException(__('exceptions.backend.access.users.cant_confirm'));
    }

    /**
     * @param \App\Models\Auth\User $user
     *
     * @throws GeneralException
     * @return \App\Models\Auth\User
     */
    public function unconfirm(User $user): User
    {
        if (! $user->confirmed) {
            throw new GeneralException(__('exceptions.backend.access.users.not_confirmed'));
        }

        if ($user->id === 1) {
            // Cant un-confirm admin
            throw new GeneralException(__('exceptions.backend.access.users.cant_unconfirm_admin'));
        }

        if ($user->id === auth()->id()) {
            // Cant un-confirm self
            throw new GeneralException(__('exceptions.backend.access.users.cant_unconfirm_self'));
        }

        $user->confirmed = false;
        $unconfirmed = $user->save();

        if ($unconfirmed) {
            event(new UserUnconfirmed($user));

            return $user;
        }

        throw new GeneralException(__('exceptions.backend.access.users.cant_unconfirm'));
    }

    /**
     * @param \App\Models\Auth\User $user
     *
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     * @return \App\Models\Auth\User
     */
    public function forceDelete(User $user)
    {
        if ($user->deleted_at === null) {
            throw new GeneralException(__('exceptions.backend.access.users.delete_first'));
        }

        return DB::transaction(function () use ($user) {
            // Delete associated relationships
            $user->passwordHistories()->delete();
            $user->providers()->delete();

            if ($user->forceDelete()) {
                event(new UserPermanentlyDeleted($user));

                return true;
            }

            throw new GeneralException(__('exceptions.backend.access.users.delete_error'));
        });
    }

    /**
     * @param \App\Models\Auth\User $user
     *
     * @throws GeneralException
     * @return \App\Models\Auth\User
     */
    public function restore(User $user): User
    {
        if ($user->deleted_at === null) {
            throw new GeneralException(__('exceptions.backend.access.users.cant_restore'));
        }

        if ($user->restore()) {
            event(new UserRestored($user));

            return $user;
        }

        throw new GeneralException(__('exceptions.backend.access.users.restore_error'));
    }

    /**
     * @param  $input
     *
     * @return mixed
     */
    protected function createUserStub($input)
    {
        $user = self::MODEL;
        $user = new $user();
        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->email = $input['email'];
        $user->mobile_no = $input['mobile_no'];
        $user->gender = $input['gender'];
        $user->province = $input['province'];
        $user->date_of_birth = $input['date_of_birth'];
        $user->password = bcrypt($input['password']);
        $user->status = isset($input['status']) ? 1 : 0;
        $user->confirmation_code = md5(uniqid(mt_rand(), true));
        $user->confirmed = isset($input['confirmed']) ? 1 : 0;
        $user->created_by = access()->user()->id;
        if(isset($input['parent_id']) && !empty($input['parent_id'])){
            $user->parent_id = $input['parent_id'];
        }

        return $user;
    }

    /**
     * @param  $roles
     *
     * @throws GeneralException
     */
    protected function checkUserRolesCount($roles)
    {
        //User Updated, Update Roles
        //Validate that there's at least one role chosen
        if (count($roles) == 0) {
            throw new GeneralException(__('exceptions.backend.access.users.role_needed'));
        }
    }

    /**
     * @return mixed
     */
    public function getUnconfirmedCount(): int
    {
        return $this->query()
            ->where('confirmed', false)
            ->count();
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc'): LengthAwarePaginator
    {
        return $this->query()
            ->with('roles', 'permissions', 'providers')
            ->active()
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return LengthAwarePaginator
     */
    public function getInactivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc'): LengthAwarePaginator
    {
        return $this->query()
            ->with('roles', 'permissions', 'providers')
            ->active(false)
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return LengthAwarePaginator
     */
    public function getDeletedPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc'): LengthAwarePaginator
    {
        return $this->query()
            ->with('roles', 'permissions', 'providers')
            ->onlyTrashed()
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    public function prescriptionStatusUpdate($request)
    {

        $id = $request['prescription_id'];
        $status = $request['status'];
       
        return DB::transaction(function () use ($id,$status) {
            $prescription = Prescription::where('id',$id)->first();
           if($status=='Cancel'){
            $nstatus = 'cancelled';
           }else{
            $nstatus = 'approved';
           }
            $prescription->status = $nstatus;
                if ($prescription->save()) {

                    $user = User::where('id',$prescription->user_id)->first();
                    
                    if(isset($user->parent_id) && !empty($user->parent_id)){ 
                        $data =  "Your Prescription no is ".$prescription->prescription_number.' & status changed to '.$user->full_name;
                        $user = User::where('id',$user->parent_id)->first(); 
                   }else{
                        $data =  "Your Prescription no is ".$prescription->prescription_number;
                        
                    }
                    if($user->mobile_no && $user->dialing_code){
                        $mobile = $user->dialing_code.$user->mobile_no;
                       // $data =  "Your Prescription no is ".$prescription->prescription_number;
                        if($prescription->status=='cancelled'){ 
                            sendMessage($mobile,'mail','patient_prescription_cancelled',$data);
                            if(isset($user->email)){
                                sendMail('mail','patient_prescription_cancelled',$data,$user->id);
                            }
                         }else{
                            sendMessage($mobile,'mail','patient_prescription_approved',$data);
                            if(isset($user->email)){
                                sendMail('mail','patient_prescription_approved',$data,$user->id);
                            }
                         }
    
                    }
               
                    return $id;
                }
           
                return 0;
            
           // throw new GeneralException(__('Problem With Prescription Status Update.'));
           });
    }

    

    public function orderStatusUpdate($data)
    {

      
       
        return DB::transaction(function () use ($data) {
            $id = $data['id'];
            $status = $data['status'];
            $type = $data['type'];
            $order = Order::where('id',$id)->first();
            if($type=='order'){
                $order->order_status = $status;
            }else{
                $order->payment_status = $status;
            }
            if ($order->save()) {

                $user = User::where('id',$order->user_id)->first();

                if(isset($user->parent_id) && !empty($user->parent_id)){ 
                    $data =  $status." & Your Order no is ".$order->order_number.' & status changed to '.$user->full_name;
                    $user = User::where('id',$user->parent_id)->first(); 
               }else{
                    $data =  $status." & Your Order no is ".$order->order_number;
                }

                if($user->mobile_no && $user->dialing_code){
                    $mobile = $user->dialing_code.$user->mobile_no;
                    // print_r($mobile);
                    // die;
                    if($type=='order'){
                   // $data =  $status." & Your Order no is ".$order->order_number;
                        sendMessage($mobile,'mail','patient_order_status',$data);
                        if(isset($user->email)){
                            sendMail('mail','patient_order_status',$data,$user->id);
                        }
                    }else{
                        $data =  $status." & Your Order no is ".$order->order_number;
                        sendMessage($mobile,'mail','patient_payment_status',$data);
                        if(isset($user->email)){
                            sendMail('mail','patient_payment_status',$data,$user->id);
                        }
                    }
                }
            
                return $id;
            
        }
        
                return 0;
            
           // throw new GeneralException(__('Problem With Prescription Status Update.'));
           });
    }

    public function transferStatusUpdate($data)
    {

      
       
        return DB::transaction(function () use ($data) {
            $id = $data['id'];
            $status = $data['status'];
            $transferRequest = TransferRequest::find($id);
            if($transferRequest){
                $transferRequest->status = $status;
            }else{
                $transferRequest->status = $transferRequest->status;
            }
            if ($transferRequest->save()) {

                $user = User::where('id',$transferRequest->user_id)->first();

                if(isset($user->parent_id) && !empty($user->parent_id)){ 
                    $data =  $status."  & Your transfer number is ".$transferRequest->transfer_number.' & status changed to '.$user->full_name;
                    $user = User::where('id',$user->parent_id)->first(); 
               }else{
                    $data =  $status."  & Your transfer number is ".$transferRequest->transfer_number;
                }
                if($user->mobile_no && $user->dialing_code){
                    $mobile = $user->dialing_code.$user->mobile_no;
                   
                    //$data =  $status."  & Your transfer number is ".$transferRequest->transfer_number;
                        sendMessage($mobile,'mail','patient_transfer_status',$data);
                        if(isset($user->email)){
                            sendMail('mail','patient_transfer_status',$data,$user->id);
                        }
                   
                }
            
                return $id;
            
        }
        
                return 0;
            
           // throw new GeneralException(__('Problem With Prescription Status Update.'));
           });
    }
    public function prescriptionRefillStatusUpdate($data)
    {
        
        return DB::transaction(function () use ($data) {
            $id = $data['id'];
            $status = $data['status'];
            $prescriptionRefill = PrescriptionRefill::find($id);
            if($prescriptionRefill){
                $prescriptionRefill->status = $status;
            }else{
                $prescriptionRefill->status = $prescriptionRefill->status;
            }
            if ($prescriptionRefill->save()) {

                $user = User::where('id',$prescriptionRefill->user_id)->first();

                if(isset($user->parent_id) && !empty($user->parent_id)){ 
                    $data =  $status.' & status changed to '.$user->full_name;
                    $user = User::where('id',$user->parent_id)->first(); 
               }else{
                    $data =  $status;
                }
                if($user->mobile_no && $user->dialing_code){
                    $mobile = $user->dialing_code.$user->mobile_no;
                   
                        sendMessage($mobile,'mail','prescription_refill_status',$data);
                        if(isset($user->email)){
                            sendMail('mail','prescription_refill_status',$data,$user->id);
                        }
                   
                }
            
                return $id;
            
            }
        
            return 0;
            
           // throw new GeneralException(__('Problem With Prescription Status Update.'));
        });
    }

    
}

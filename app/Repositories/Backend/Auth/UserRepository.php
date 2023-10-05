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
use App\Models\HealthInformation;
use App\Models\PaymentMethod;
use App\Models\Insurance;
use App\Models\Medication;
use App\Models\MedicationItem;
use File;
use Ramsey\Uuid\Uuid;




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
    public function getForDataTable($status = 1, $trashed = false)
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
                return true;
            }
            
            throw new GeneralException(__('Problem With Update Payment Method.'));
           });
    }
    public function create_address(array $data)
    {
        $user_id = $data['user_id'];
       
        return DB::transaction(function () use ($data,$user_id) {
            Address::where('user_id',$user_id)->update(array('address_type' => 'normal'));
            $address = new Address;
            $address->user_id = $user_id;
            $address->address1 = $data['address1'];
            $address->address2 = $data['address2'];
            $address->postal_code = $data['postal_code'];
            $address->city = $data['city'];
            $address->province = $data['province'];
            $address->address_type = 'default';
            $address->is_verify = 1;
            if($address->save()){
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
            Address::where('user_id',$user_id)->update(array('address_type' => 'normal'));
           
            $address =  Address::where('id',$address_id)->first();
            $address->user_id = $user_id;
            $address->address1 = $data['address1'];
            $address->address2 = $data['address2'];
            $address->postal_code = $data['postal_code'];
            $address->city = $data['city'];
            $address->province = $data['province'];
            $address->address_type = 'default';
            $address->is_verify = 1;
            if($address->save()){
                return true;
            }
            
            throw new GeneralException(__('Problem With create Address.'));
           });
    }
    
    public function create_healthcard(array $data,$files)
    {
        $user_id = $data['user_id'];
        $healthcard_number = $data['healthcard_number'];
        return DB::transaction(function () use ($user_id,$healthcard_number,$files) {
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
            if ($healthCard === null) {
                $healthCard  = new HealthCard;
                $healthCard->user_id = $user_id;
             
             }
            $healthCard->front_img = $healthCardImages[0];
            $healthCard->back_img = $healthCardImages[1];
            $healthCard->is_verify = 1;
            $healthCard->card_number = $healthcard_number;
            if($healthCard->save()){
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
            if ($insurance === null) {
                $insurance  = new Insurance;
                $insurance->user_id = $user_id;
                $insurance->type = $type;
             
             }
             if(isset($insuranceImages[0])){
                $insurance->front_img = $insuranceImages[0];
            }
            if(isset($insuranceImages[1])){
                $insurance->back_img = $insuranceImages[1];
            }
            $insurance->is_verify = 1;
            if($insurance->save()){
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
            if ($HealthInformation === null) {
                $HealthInformation  = new HealthInformation;
                $HealthInformation->user_id = $user_id;
             
             }
            $HealthInformation->allergies = $data['allergies'];
            $HealthInformation->supplements_medications = $data['supplements_medications'];
            if($data['allergies']==1){
                $HealthInformation->allergies_medications = $data['allergies_medications'];
            }else{
                $HealthInformation->allergies_medications = null;
            }
            if($HealthInformation->save()){
                return true;
            }
           
          
    
            
            throw new GeneralException(__('Problem With Upadate Health Information.'));
           });
    }
    public function create_prescription(array $data,$files)
    {
        $user_id = $data['user_id'];
        return DB::transaction(function () use ($user_id,$files) {
            if(isset($files)){
                if(count($files)>0){
                    $prescription = new Prescription;
                    $prescription->prescription_number = Prescription::generatePrescriptionNumber();
                    $prescription->user_id = $user_id;
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
            
            $medication = Medication::where('user_id',$data['user_id'])->where('prescription_id',$data['prescription_id'])->first();
            // print_r($medication);
            // die;
                if ($medication === null) {
                    $medication  = new Medication;
                    
                }
            $medication->prescription_id = $data['prescription_id'];
            $medication->user_id = $data['user_id'];
            $medication->created_by = access()->user()->id;
            if($medication->save()){
                foreach($data['drug'] as $key => $drug){
                    $medicationItem = new MedicationItem;
                    $medicationItem->medication_id = $medication->id;
                    $medicationItem->drug_id = $drug;
                    $medicationItem->qty_left = $data['qty_left'][$key];
                    $medicationItem->qty_filled = $data['qty_filled'][$key];
                    $medicationItem->prescribing_doctor = $data['prescribing_doctor'];
                    $medicationItem->pharmacy = $data['pharmacy'];
                    $medicationItem->save();
                }
                
                return true;
            }
       
        
            
        throw new GeneralException(__('Problem With Create Medication.'));
       });
    }
    public function create(array $data,$files)
    {
        // print_r($files);
        // die;
        $roles = $data['assignees_roles'];
        $permissions = $data['permissions'];
        // $permissions = $data['files'];

        unset($data['assignees_roles']);
        unset($data['permissions']);

        $user = $this->createUserStub($data);

        return DB::transaction(function () use ($user, $data, $roles, $permissions,$files) {
            if ($user->save()) {
                //Attach new roles
                $user->attachRoles($roles);

                // Attach New Permissions
                $user->attachPermissions($permissions);

                //Send confirmation email if requested and account approval is off
                if (isset($data['confirmation_email']) && $user->confirmed == 0) {
                    $user->notify(new UserNeedsConfirmation($user->confirmation_code));
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
    public function update(User $user, array $data)
    {
        $roles = $data['assignees_roles'];
        $permissions = $data['permissions'];

        unset($data['assignees_roles']);
        unset($data['permissions']);

        return DB::transaction(function () use ($user, $data, $roles, $permissions) {
          
            $user->status = isset($data['status']) && $data['status'] == '1' ? 1 : 0;
            $user->confirmed = isset($data['confirmed']) && $data['confirmed'] == '1' ? 1 : 0;
            $user->gender = isset($data['gender']) ? $data['gender'] : null;
            $user->date_of_birth = isset($data['date_of_birth']) ? $data['date_of_birth'] : null;
            $user->province = isset($data['province']) ? $data['province'] : null;
//   print_r($data);
//             die;
            if ($user->update($data)) {
                $user->roles()->sync($roles);
                $user->permissions()->sync($permissions);

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
}

<?php

namespace App\Models\Auth\Traits\Relationships;

use App\Models\Auth\PasswordHistory;
use App\Models\Auth\Permission;
use App\Models\Auth\Role;
use App\Models\Auth\SocialAccount;
use App\Models\Address;
use App\Models\HealthCard;
use App\Models\Insurance;
use App\Models\PaymentMethod;
use App\Models\HealthInformation;
use App\Models\Prescription;


trait UserRelationships
{
    /**
     * @return mixed
     */
    public function providers()
    {
        return $this->hasMany(SocialAccount::class);
    }

    /**
     * @return mixed
     */
    public function passwordHistories()
    {
        return $this->hasMany(PasswordHistory::class);
    }

    /**
     * @return mixed
     */
    public function sessions()
    {
        return $this->hasMany(Session::class);
    }

    /**
     * Many-to-Many relations with Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Many-to-Many relations with Permission.
     * ONLY GETS PERMISSIONS ARE NOT ASSOCIATED WITH A ROLE.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function address()
    {
        return $this->hasMany(Address::class);
    }
    
    public function healthcard()
    {
        return $this->hasOne(HealthCard::class);
    }
    public function insurance()
    {
        return $this->hasMany(Insurance::class);
    }
    public function paymentmethod()
    {
        return $this->hasMany(PaymentMethod::class);
    }
    public function healthinformation()
    {
        return $this->hasOne(HealthInformation::class);
    }
    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }
    
    
}
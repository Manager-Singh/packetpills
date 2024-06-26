<?php

namespace App\Models\Auth\Traits\Methods;

trait UserMethods
{
    /**
     * @return mixed
     */
    public function canChangeEmail()
    {
        return config('access.users.change_email');
    }

    /**
     * @return bool
     */
    public function canChangePassword()
    {
        return ! app('session')->has(config('access.socialite_session_name'));
    }

    /**
     * @param bool $size
     *
     * @throws \Illuminate\Container\EntryNotFoundException
     * @return bool|\Illuminate\Contracts\Routing\UrlGenerator|mixed|string
     */
    public function getPicture($size = false)
    {
        switch ($this->avatar_type) {
            case 'gravatar':
                if (! $size) {
                    $size = config('gravatar.default.size');
                }
                // die($this->email);
                if(isset($this->email)){
                    return gravatar()->get($this->email, ['size' => $size]);
                }else{
                    return url('storage/'.$this->avatar_location);
                }


            case 'storage':
                return url('storage/'.$this->avatar_location);
            case 'upload':
                    return url($this->avatar_location);
        }

        $social_avatar = $this->providers()->where('provider', $this->avatar_type)->first();

        if ($social_avatar && strlen($social_avatar->avatar)) {
            return $social_avatar->avatar;
        }

        return false;
    }

    /**
     * @param $provider
     *
     * @return bool
     */
    public function hasProvider($provider)
    {
        foreach ($this->providers as $p) {
            if ($p->provider == $provider) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function isAdmin()
    {
        // return $this->hasRole('Administrator');
        return $this->whereHas('roles', function ($query) {
            $query->where('name', 'Administrator');
        })->exists();
    }

    public function isEmploye()
    {
        return $this->whereHas('roles', function ($query) {
            $query->where('name', 'Employee');
        })->exists();
    }
    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->status;
    }

    /**
     * @return bool
     */
    public function isConfirmed()
    {
        return $this->confirmed;
    }

    /**
     * @return bool
     */
    public function isPending()
    {
        return config('access.users.requires_approval') && ! $this->confirmed;
    }
}

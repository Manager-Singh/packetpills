<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User;

class UserReferal extends Model
{
  

    protected $table = 'user_referal'; // Explicitly define table name

    protected $fillable = [
        'user_id',         // The user who is being referred
        'from_you_found',  // Source of referral (Instagram, Twitter, etc.)
        'refred_by',  // Source of referral (Instagram, Twitter, etc.)refred_by
        'other_message',   // Custom message if 'Other' is selected
        'name',            // Referring user's name
        'email',           // Referring user's email
        'contact_number',  // Referring user's contact number
        'refreal_user_id', // ID of the user who referred
        'created_at',      
        'updated_at',
    ];

    // Define relationships (if needed)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function referrer()
    {
        return $this->belongsTo(User::class, 'refreal_user_id');
    }
}
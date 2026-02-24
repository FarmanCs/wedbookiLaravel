<?php

namespace App\Models\Guest;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'email',
        'full_name',
        'phone_no',
        'mobile_no',
        'address',
        'state',
        'city',
        'zipcode',
        'is_joining',
    ];

    // Relationships
    public function guestGroups()
    {
        return $this->belongsToMany(GuestGroup::class, 'guest_group_guest');
    }
}
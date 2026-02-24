<?php

namespace App\Models\Guest;

use App\Models\Host\Host;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GuestGroup extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'group_name',
        'host_id',
    ];

    // Relationships
    public function host()
    {
        return $this->belongsTo(Host::class);
    }

    public function guests()
    {
        return $this->belongsToMany(Guest::class, 'guest_group_guest');
    }
}
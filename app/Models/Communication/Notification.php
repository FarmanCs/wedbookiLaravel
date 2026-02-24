<?php

namespace App\Models\Communication;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'message', 'type', 'recipients', 'delivery_method',
        'send_mode', 'scheduled_at', 'status',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];
}
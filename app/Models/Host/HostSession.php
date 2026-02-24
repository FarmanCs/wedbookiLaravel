<?php

namespace App\Models\Host;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HostSession extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'host_id',
        'session_status',
        'params',
        'started_at',
    ];

    protected $casts = [
        'params' => 'json',
        'started_at' => 'datetime',
    ];

    // Relationships
    public function host()
    {
        return $this->belongsTo(Host::class);
    }
}
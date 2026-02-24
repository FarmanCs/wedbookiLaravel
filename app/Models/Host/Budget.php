<?php

namespace App\Models\Host;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Budget extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'host_id',
        'total_budget',
        'breakdown',
    ];

    protected $casts = [
        'total_budget' => 'decimal:2',
        'breakdown' => 'json',
    ];

    // Relationships
    public function host()
    {
        return $this->belongsTo(Host::class);
    }
}
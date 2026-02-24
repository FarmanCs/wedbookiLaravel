<?php

namespace App\Models\Timing;

use App\Models\Host\Host;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Checklist extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['host_id', 'wedding_date', 'checklist_items'];

    protected $casts = [
        'wedding_date' => 'date',
        'checklist_items' => 'array',
    ];

    public function host()
    {
        return $this->belongsTo(Host::class);
    }
}
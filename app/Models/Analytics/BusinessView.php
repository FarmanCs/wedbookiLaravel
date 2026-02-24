<?php

namespace App\Models\Analytics;

use App\Models\Business\Business;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessView extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['business_id', 'device_id', 'viewed_at'];

    protected $casts = ['viewed_at' => 'datetime'];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
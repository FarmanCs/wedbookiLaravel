<?php

namespace App\Models\Subscription;

use App\Models\Business\Business;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'plans_transactions';

    protected $fillable = [
        'business_id', 'plan_id', 'tran_time', 'from', 'to', 'amount', 'tran_type'
    ];

    protected $casts = [
        'tran_time' => 'datetime',
        'amount' => 'decimal:2',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
<?php

namespace App\Models\Subscription;

use App\Models\Business\Business;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreditsTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'credits_transactions';

    protected $fillable = [
        'business_id', 'no_of_credits', 'amount', 'from', 'to', 'tran_type'
    ];

    protected $casts = [
        'no_of_credits' => 'integer',
        'amount' => 'decimal:2',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
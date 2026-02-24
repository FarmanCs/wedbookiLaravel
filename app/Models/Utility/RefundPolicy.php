<?php

namespace App\Models\Utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefundPolicy extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['refund_policy'];
}
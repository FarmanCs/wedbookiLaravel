<?php

namespace App\Models\Utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrivacyPolicy extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['privacy_policy'];

    public $timestamps = false; // Only updated_at is present, but we'll keep timestamps false and manually handle.

    protected $casts = ['updated_at' => 'datetime'];
}
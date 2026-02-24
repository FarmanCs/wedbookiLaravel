<?php

namespace App\Models\Utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TermsAndCondition extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'terms_and_conditions';

    protected $fillable = ['terms_and_conditions'];

    public $timestamps = false; // We'll manage created_at/updated_at manually if needed.
}
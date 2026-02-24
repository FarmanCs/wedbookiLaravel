<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminFaq extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'admin_faqs';

    protected $fillable = ['question', 'answer', 'status'];

    
}
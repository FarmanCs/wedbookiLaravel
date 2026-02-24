<?php

namespace App\Models\Timing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChecklistTemplate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['event_type', 'checklist_items'];

    protected $casts = ['checklist_items' => 'array'];
}
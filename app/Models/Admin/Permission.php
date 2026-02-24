<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; // No SoftDeletes

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'key', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];
}
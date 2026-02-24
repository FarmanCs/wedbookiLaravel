<?php

namespace App\Models\Admin;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; // No SoftDeletes

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_role');
    }
}
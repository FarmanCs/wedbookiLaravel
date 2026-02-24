<?php

namespace App\Models\Feature;

use App\Models\Subscription\Plan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feature extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'key', 'description', 'value', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function adminPackages()
    {
        return $this->belongsToMany(AdminPackage::class, 'feature_package');
    }

    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'feature_plan');
    }
}
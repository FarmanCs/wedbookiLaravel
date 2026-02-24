<?php

namespace App\Models\Communication;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupportQuery extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'full_name', 'email', 'phone_number', 'subject', 'priority',
        'message', 'attachments', 'status',
    ];

    protected $casts = ['attachments' => 'array'];

    /**
     * Scope a query to only include pending support queries.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
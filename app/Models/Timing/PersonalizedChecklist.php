<?php

namespace App\Models\Timing;

use App\Models\Host\Host;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonalizedChecklist extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'host_id',
        'check_list_title',
        'check_list_category',
        'check_list_description',
        'check_list_due_date',
        'checklist_status',
        'is_custom',
    ];

    protected $casts = [
        'check_list_due_date' => 'datetime',
        'is_custom' => 'boolean',
    ];

    public function host()
    {
        return $this->belongsTo(Host::class);
    }
}

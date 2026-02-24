<?php

namespace App\Models\Timing;

use App\Models\Host\Host;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonalizedChecklist extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'host_id', 'check_list_title', 'check_list_category', 'check_list_description',
        'check_list_due_date', 'checklist_status', 'check_list_item_linked_with',
        'check_list_item_linked_with_id', 'checklist_linked_booking_id',
        'checklist_linked_booking', 'is_custom', 'is_edited', 'lock_to_wedding_date',
    ];

    protected $casts = [
        'check_list_due_date' => 'date',
        'is_custom' => 'boolean',
        'is_edited' => 'boolean',
        'lock_to_wedding_date' => 'boolean',
    ];

    public function host()
    {
        return $this->belongsTo(Host::class);
    }
}
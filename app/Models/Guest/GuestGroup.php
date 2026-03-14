<?php

namespace App\Models\Guest;

use App\Models\Host\Host;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GuestGroup extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'group_name',
        'host_id',
    ];

    protected $table = 'guest_groups';

    // ============== RELATIONSHIPS ==============

    public function host()
    {
        return $this->belongsTo(Host::class);
    }

    public function guests()
    {
        return $this->belongsToMany(
            Guest::class,
            'guest_group_guest',
            'guest_group_id',  // ← Foreign key for this model
            'guest_id'          // ← Foreign key for Guest model
        );
    }

    // ============== ACCESSOR METHODS ==============
    // These are NOT database columns - they calculate counts on-the-fly
    // This solves the "Column not found" error!

    /**
     * Get total guests in this group
     * @return int
     */
    public function getTotalGuestsAttribute()
    {
        return $this->guests()->count();
    }

    /**
     * Get accepted guests count (where is_joining = 'Accepted')
     * @return int
     */
    public function getAcceptedGuestsAttribute()
    {
        return $this->guests()
            ->where('is_joining', 'Accepted')
            ->count();
    }

    /**
     * Get pending guests count (where is_joining = 'Pending')
     * @return int
     */
    public function getPendingGuestsAttribute()
    {
        return $this->guests()
            ->where('is_joining', 'Pending')
            ->count();
    }

    /**
     * Get rejected guests count (where is_joining = 'Rejected')
     * @return int
     */
    public function getRejectedGuestsAttribute()
    {
        return $this->guests()
            ->where('is_joining', 'Rejected')
            ->count();
    }

    /**
     * Get confirmation rate percentage
     * @return int
     */
    public function getConfirmationRateAttribute()
    {
        $total = $this->getTotalGuestsAttribute();
        if ($total === 0) {
            return 0;
        }
        return (int)(($this->getAcceptedGuestsAttribute() / $total) * 100);
    }

    /**
     * Magic accessor - allows $group->total_guests to work
     */
    protected $appends = ['total_guests', 'accepted_guests', 'pending_guests', 'rejected_guests', 'confirmation_rate'];
}

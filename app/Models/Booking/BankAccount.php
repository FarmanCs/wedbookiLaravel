<?php


namespace App\Models\Booking;

use App\Models\Vendor\Vendor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankAccount extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'vendor_id',
        'account_holder_name',
        'bank_name',
        'bank_code',
        'account_number',
        'account_last4',
        'iban',
        'swift',
        'currency',
        'is_default',
        'notes',
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function getMaskedAccountNumberAttribute()
    {
        return $this->account_last4 ? '••••' . $this->account_last4 : '••••';
    }
}

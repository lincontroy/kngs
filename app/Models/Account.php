<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'available_balance',
        'currency',
        'active_deposit',
        'total_earnings',
        'total_withdrawal',
        'kyc_status',
        'account_type',
        'user_id'
    ];

    protected $casts = [
        'available_balance' => 'decimal:2',
        'active_deposit' => 'decimal:2',
        'total_earnings' => 'decimal:2',
        'total_withdrawal' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFormattedBalanceAttribute()
    {
        return '$' . number_format($this->available_balance, 2) . ' ' . $this->currency;
    }

    public function getKycStatusColorAttribute()
    {
        return match($this->kyc_status) {
            'Verified' => '#4CAF50',
            'Pending' => '#FF9800',
            'Rejected' => '#F44336',
        };
    }

    public function getAccountTypeColorAttribute()
    {
        return match($this->account_type) {
            'Basic' => '#FF9800',
            'Premium' => '#2196F3',
            'VIP' => '#9C27B0',
        };
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Account;
use App\Models\User;

class AccountSeeder extends Seeder
{
    public function run()
    {
        $user = User::first();
        
        Account::create([
            'available_balance' => 156.90,
            'currency' => 'USD',
            'active_deposit' => 100.00,
            'total_earnings' => 9941.00,
            'total_withdrawal' => 0.00,
            'kyc_status' => 'Verified',
            'account_type' => 'Basic',
            'user_id' => $user->id,
        ]);
    }
}
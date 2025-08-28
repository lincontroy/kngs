<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->decimal('available_balance', 12, 2)->default(0);
            $table->string('currency', 3)->default('USD');
            $table->decimal('active_deposit', 12, 2)->default(0);
            $table->decimal('total_earnings', 12, 2)->default(0);
            $table->decimal('total_withdrawal', 12, 2)->default(0);
            $table->enum('kyc_status', ['Pending', 'Verified', 'Rejected'])->default('Pending');
            $table->enum('account_type', ['Basic', 'Premium', 'VIP'])->default('Basic');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('accounts');
    }
};
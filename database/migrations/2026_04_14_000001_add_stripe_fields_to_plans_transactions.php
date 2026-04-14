<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('plans_transactions', function (Blueprint $table) {
            // Add Stripe tracking fields
            $table->string('stripe_session_id')->nullable()->unique()->after('transaction_type');
            $table->string('payment_intent_id')->nullable()->after('stripe_session_id');
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded'])->default('pending')->after('payment_intent_id');
        });
    }

    public function down(): void
    {
        Schema::table('plans_transactions', function (Blueprint $table) {
            $table->dropColumn(['stripe_session_id', 'payment_intent_id', 'status']);
        });
    }
};

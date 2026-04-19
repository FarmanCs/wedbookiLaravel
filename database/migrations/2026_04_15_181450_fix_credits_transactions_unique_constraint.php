<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop the old unique constraint
        Schema::table('credits_transactions', function (Blueprint $table) {
            $table->dropUnique('credits_transactions_stripe_session_id_unique');
        });

        // Add composite unique constraint (stripe_session_id, credit_id)
        // This allows multiple credits per checkout session, but prevents duplicate credit entries
        Schema::table('credits_transactions', function (Blueprint $table) {
            $table->unique(['stripe_session_id', 'credit_id'], 'credits_transactions_session_credit_unique');
        });
    }

    public function down(): void
    {
        Schema::table('credits_transactions', function (Blueprint $table) {
            $table->dropUnique('credits_transactions_session_credit_unique');
        });

        Schema::table('credits_transactions', function (Blueprint $table) {
            $table->unique('stripe_session_id');
        });
    }
};

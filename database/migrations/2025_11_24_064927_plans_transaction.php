<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plans_transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('business_id')
                ->constrained('businesses')
                ->cascadeOnDelete();

            $table->foreignId('plan_id')
                ->constrained('plans')
                ->cascadeOnDelete();

            // transaction time (payment time)
            $table->timestamp('transaction_time')->useCurrent();

            // subscription duration
            $table->timestamp('start_at')->nullable();   // FROM
            $table->timestamp('end_at')->nullable();     // TO

            $table->decimal('amount', 10, 2)->default(0);

            $table->enum('transaction_type', [
                'purchase',
                'renewal'
            ]);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plans_transactions');
    }
};

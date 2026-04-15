<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('credits_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')
                ->nullable()
                ->constrained('businesses')
                ->nullOnDelete();

            $table->foreignId('vendor_id')
                ->nullable()
                ->constrained('vendors')
                ->nullOnDelete();

            $table->foreignId('credit_id')
                ->nullable()
                ->constrained('credits')
                ->nullOnDelete();


            $table->integer('no_of_credits')->default(0);
            $table->decimal('amount', 10, 2)->default(0);

            // avoid reserved keywords
            $table->string('from_source')->nullable();
            $table->string('to_source')->nullable();
            $table->integer('ad_credits')->default(0);


            $table->string('stripe_session_id')->nullable()->unique();
            $table->string('payment_intent_id')->nullable();
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded'])->default('pending');
            $table->enum('tran_type', ['purchase', 'refund', 'adjustment'])->default('purchase');
            $table->timestamp('from')->nullable();
            $table->timestamp('to')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('credits_transactions');
    }
};

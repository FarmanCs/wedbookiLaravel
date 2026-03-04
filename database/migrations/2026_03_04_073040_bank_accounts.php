<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_bank_accounts_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained()->onDelete('cascade');
            $table->string('account_holder_name');
            $table->string('bank_name');
            $table->string('bank_code')->nullable(); // routing/sort code
            $table->string('account_number')->nullable();
            $table->string('account_last4', 4)->nullable();
            $table->string('iban')->nullable();
            $table->string('swift')->nullable();
            $table->string('currency', 3)->default('PKR');
            $table->boolean('is_default')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('vendor_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bank_accounts');
    }
};

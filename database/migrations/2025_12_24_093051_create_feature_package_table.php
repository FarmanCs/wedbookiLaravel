<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new  class extends Migration {
    public function up(): void
    {
        Schema::create('feature_package', function (Blueprint $table) {
            $table->id();

            $table->foreignId('package_id') // Note: table name is admin_packages
                ->constrained('packages')
                ->cascadeOnDelete();

            $table->foreignId('feature_id')
                ->constrained('features')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feature_package');
    }
};

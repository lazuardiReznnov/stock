<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('spesifications', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('unit_id')
                ->constrained('units')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('vin')->nullable();
            $table->string('en')->nullable();
            $table->year('year')->nullable();
            $table->string('color')->nullable();
            $table->string('model')->nullable();
            $table->string('fuel')->nullable();
            $table->string('cylinder')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spesifications');
    }
};

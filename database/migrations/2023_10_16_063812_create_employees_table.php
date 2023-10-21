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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('division_id')
                ->constrained('divisions')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('identity')->unique();
            $table->text('address')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->date('birth')->nullable();
            $table->string('born')->nullable();
            $table->string('gender')->nullable();
            $table->string('martial')->nullable();
            $table->string('relegion')->nullable();
            $table->string('weight')->nullable();
            $table->string('height')->nullable();
            $table->string('driver_license')->nullable();
            $table->string('tin')->nullable();
            $table->string('skill')->nullable();
            $table->string('position')->nullable();
            $table->date('entry')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};

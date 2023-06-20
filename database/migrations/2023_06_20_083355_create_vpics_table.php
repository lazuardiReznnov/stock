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
        Schema::create('vpics', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('unit_id')
                ->constrained('units')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('owner')->nullable();
            $table->string('address')->nullable();
            $table->string('region')->nullable();
            $table->date('tgl_reg')->nullable();
            $table->date('expire')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vpics');
    }
};

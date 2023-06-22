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
        Schema::create('maintenance_parts', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('maintenance_id')
                ->constrained('maintenances')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table
                ->foreignId('sparepart_id')
                ->constrained('spareparts')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->integer('qty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mantenance_parts');
    }
};

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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('invoicing_id')
                ->nullable()
                ->constrained('invoicings')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table
                ->foreignId('region_id')
                ->constrained('regions')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table
                ->foreignId('unit_id')
                ->constrained('units')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table
                ->string('letter_number')
                ->unique()
                ->nullable();
            $table->string('recipient');
            $table->string('address');
            $table->string('type');
            $table->integer('weight');
            $table->integer('cost');
            $table->integer('transport');
            $table->integer('driver_fee');
            $table->integer('mark_fee');
            $table->integer('inline_fee');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

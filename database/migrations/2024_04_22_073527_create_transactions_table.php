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
                ->foreignId('customer_id')
                ->nullable()
                ->constrained('customers')
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
            $table->string('recipient')->nullable();
            $table->string('address')->nullable();
            $table->integer('area');
            $table->string('region');
            $table->string('type');
            $table->string('fare');
            $table->integer('weight')->nullable();
            $table->integer('cost')->nullable();
            $table->integer('transport')->nullable();
            $table->integer('driver_fee')->nullable();
            $table->integer('mark_fee')->nullable();
            $table->integer('inline_fee')->nullable();
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

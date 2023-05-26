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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('sparepart_id')
                ->constrained('spareparts')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table
                ->foreignId('invoice_stock_id')
                ->constrained('invoice_stocks')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('brand');
            $table->integer('qty');
            $table->integer('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};

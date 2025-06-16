<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('order_lines', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->float('price');
            $table->boolean('status')->default(false);
            $table->foreignId('order_id');
            $table->foreignId('product_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_lines');
    }
};

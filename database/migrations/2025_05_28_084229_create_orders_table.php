<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('table_number');
            $table->string('person_number');
            $table->dateTime('delivery_time')->nullable();
            $table->string('name')->nullable();
            $table->string('phone_number')->nullable();
            $table->text('comment')->nullable();
            $table->string('state');
            $table->string('type');
            $table->boolean('paid');
            $table->float('total_price');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

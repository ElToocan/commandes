<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('service');
            $table->dateTime('deliveryTime')->nullable();
            $table->string('name')->nullable();
            $table->string('phoneNumber')->nullable();
            $table->string('state');
            $table->string('type');
            $table->boolean('paid');
            $table->float('totalPrice');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

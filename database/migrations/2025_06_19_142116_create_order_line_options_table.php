<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('order_line_options', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->foreignId('order_line_id');
            $table->foreignId('option_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_line_options');
    }
};

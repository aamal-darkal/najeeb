<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->foreignId('payment_method_id');
            $table->string('bill_number')->unique();
            $table->string('amount');
            $table->string('start_duration_date');
            $table->enum('state',['pending','rejected','approved'])->default('pending');
            $table->dateTime('payment_date')->nullable();
            $table->dateTime('confirm_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

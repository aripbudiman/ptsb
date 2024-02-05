<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('branch_id')->constrained('branches')->onDelete('cascade');
            $table->date('tanggal');
            $table->string('invoice');
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->decimal('total_amount', 10, 0);
            $table->decimal('cash',10,0);
            $table->enum('payment_method',['cash','transfer'])->default('cash');
            $table->text('description')->nullable(true);
            $table->enum('status',['pending','unpaid','paid'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

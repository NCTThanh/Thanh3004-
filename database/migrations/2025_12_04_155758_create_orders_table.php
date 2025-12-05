<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('car_id')->constrained()->onDelete('cascade'); // Xe được đặt
        $table->string('order_code')->unique(); // Mã đơn hàng 
        $table->decimal('amount', 15, 2); // Số tiền cọc
        $table->string('status')->default('pending'); // pending, approved, cancelled
        $table->string('payment_method')->default('bank_transfer');
        $table->text('admin_note')->nullable(); 
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

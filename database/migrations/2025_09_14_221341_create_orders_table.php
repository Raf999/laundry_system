<?php

use App\Enum\DeliveryType;
use App\Enum\OrderStatus;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->index();
            $table->foreignId('user_id');
            $table->foreignId('company_id');
            $table->foreignId('staff_in_id'); // person who received the order
            $table->string('status')->default(OrderStatus::PROCESSING->value);
            $table->string('delivery_type')->default(DeliveryType::STORE_PICKUP->value)->index();
            $table->string('delivery_address')->nullable();
            $table->decimal('delivery_cost', 10, 2)->default(0.00);
            $table->decimal('amount_paid', 10, 2)->default(0.00);
            $table->decimal('discount_amount', 10, 2)->default(0.00);
            $table->string('payment_method')->index();
            $table->timestamp('estimated_completion_date')->nullable();
            $table->timestamp('completed_at')->nullable();
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

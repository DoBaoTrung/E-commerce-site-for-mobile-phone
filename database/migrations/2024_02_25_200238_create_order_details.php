<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_details', function (Blueprint $table) {
            // $table->id();
            $table->foreignUuid('order_id')->constrained('orders');
            $table->string('name_receiver');
            $table->string('phone_receiver', 20);
            $table->string('email_receiver')->nullable();
            $table->text('address_receiver');
            $table->foreignId('product_id')->constrained('products');
            $table->integer('quantity');
            $table->unsignedBigInteger('unit_price');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};

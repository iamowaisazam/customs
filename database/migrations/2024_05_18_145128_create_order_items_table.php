<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key with AUTO_INCREMENT
            $table->unsignedBigInteger('order_id'); // Foreign key for order ID
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->unsignedBigInteger('variation_id'); // Foreign key for variation ID
            $table->foreign('variation_id')->references('id')->on('variations')->onDelete('cascade');
            $table->text('title')->nullable(); // Text column for title, nullable
            $table->text('sku')->nullable(); // Text column for SKU, nullable
            $table->text('image_id')->nullable(); // Text column for image ID, nullable
            $table->decimal('quantity', 10, 0)->nullable(); // Decimal column for quantity, nullable
            $table->decimal('price', 10, 0)->nullable(); // Decimal column for price, nullable
            $table->decimal('total', 10, 0)->nullable(); // Decimal column for total, nullable
            $table->text('attr')->nullable(); // Text column for attributes, nullable
            $table->timestamp('created_at')->useCurrent(); // Timestamp for created_at with current timestamp default
            $table->timestamp('updated_at')->useCurrent(); // Timestamp for updated_at with current timestamp default
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}

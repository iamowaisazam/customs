<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key with AUTO_INCREMENT
            $table->text('tracking_id')->nullable(); // Text column for tracking ID, nullable
            $table->string('sno', 255)->nullable(); // VARCHAR(255) column for serial number, nullable
            $table->string('customer_name', 255)->nullable(); // VARCHAR(255) column for customer name, nullable
            $table->string('customer_email', 255)->nullable(); // VARCHAR(255) column for customer email, nullable
            $table->string('customer_phone', 255)->nullable(); // VARCHAR(255) column for customer phone, nullable
            $table->string('country', 255)->nullable(); // VARCHAR(255) column for country, nullable
            $table->string('city', 50)->nullable(); // VARCHAR(50) column for city, nullable
            $table->text('address')->nullable(); // Text column for address, nullable
            $table->string('payment_method', 255)->nullable(); // VARCHAR(255) column for payment method, nullable
            $table->string('payment_status', 255)->nullable(); // VARCHAR(255) column for payment status, nullable
            $table->text('order_status'); // Text column for order status, not nullable
            $table->text('order_notes')->nullable(); // Text column for order notes, nullable
            $table->double('subtotal')->nullable(); // Double column for subtotal, nullable
            $table->double('delivery_charges')->default(0); // Double column for delivery charges with default value 0
            $table->double('grandtotal')->nullable(); // Double column for grand total, nullable
            $table->integer('is_enable')->default(1); // Integer column for is_enable with default value 1
            $table->timestamp('created_at')->useCurrent(); // Timestamp for created_at with current timestamp default
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent(); // Timestamp for updated_at with current timestamp default and on update
            $table->text('customer_notes')->nullable(); // Text column for customer notes, nullable
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

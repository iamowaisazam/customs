<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variations', function (Blueprint $table) {
            $table->id(); // Primary key column with auto-increment
            $table->unsignedBigInteger('product_id'); // Product ID column with index
            $table->string('sku')->nullable(); // SKU column of type varchar(255) allowing NULL values
            $table->integer('quantity')->nullable(); // Quantity column of type int(11) allowing NULL values
            $table->integer('price')->nullable(); // Price column of type int(11) allowing NULL values
            $table->text('image')->nullable(); // Image column of type text allowing NULL values
            $table->timestamps(); // Adds created_at and updated_at columns of type timestamp

            // Foreign key constraint for product_id referencing products table
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('variations');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_collections', function (Blueprint $table) {
            $table->id(); // Primary key column with auto-increment
            $table->unsignedBigInteger('product_id'); // Product ID column of type big integer
            $table->unsignedBigInteger('collection_id'); // Collection ID column of type big integer
            $table->tinyInteger('is_enable')->default(1); // Default 1 for is_enable column of type tiny integer
            $table->timestamps(); // Adds created_at and updated_at columns of type timestamp

            // Foreign key constraints
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('collection_id')->references('id')->on('collections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_collections');
    }
}

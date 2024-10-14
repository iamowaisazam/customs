<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariationAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variation_attributes', function (Blueprint $table) {
            $table->id(); // Primary key column with auto-increment
            $table->unsignedBigInteger('variation_id'); // Variation ID column with index
            $table->integer('attribute_id')->nullable(); // Attribute ID column of type int(50) allowing NULL values
            $table->unsignedBigInteger('value_id')->nullable(); // Value ID column with index
            $table->string('value')->nullable(); // Value column of type varchar(255) allowing NULL values
            $table->timestamps(); // Adds created_at and updated_at columns of type timestamp

            // Foreign key constraints
            $table->foreign('variation_id')->references('id')->on('variations')->onDelete('cascade');
            $table->foreign('value_id')->references('id')->on('values')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('variation_attributes');
    }
}

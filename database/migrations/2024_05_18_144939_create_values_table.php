<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('values', function (Blueprint $table) {
            $table->id(); // Primary key column with auto-increment
            $table->string('title'); // Title column of type varchar(255)
            $table->unsignedBigInteger('attribute_id'); // Attribute ID column of type int(11)
            $table->timestamps(); // Adds created_at and updated_at columns of type timestamp

            // Foreign key constraint for attribute_id referencing attributes table
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('values');
    }
}

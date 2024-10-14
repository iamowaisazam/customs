<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_status', function (Blueprint $table) {
            $table->id(); // Primary key with AUTO_INCREMENT
            $table->text('title'); // Text column for title
            $table->boolean('is_enable')->default(1); // Boolean column for is_enable, default value set to true
            $table->timestamps(); // Adds created_at and updated_at columns with timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_status');
    }
}


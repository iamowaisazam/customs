<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id(); // Primary key column with auto-increment
            $table->text('title')->nullable(); // Nullable title column of type text
            $table->text('slug')->nullable(); // Nullable slug column of type text
            $table->text('message')->nullable(); // Nullable message column of type text
            $table->boolean('is_enable')->default(true); // Boolean is_enable column with default value true
            $table->timestamps(); // Adds created_at and updated_at columns of type timestamp
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_methods');
    }
}

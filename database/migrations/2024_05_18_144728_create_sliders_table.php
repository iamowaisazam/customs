<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id(); // Primary key column with auto-increment
            $table->string('title'); // Title column of type varchar(255)
            $table->string('slug')->nullable(); // Slug column of type varchar(255), nullable
            $table->text('details')->nullable(); // Details column of type text, nullable
            $table->text('image_id')->nullable(); // Image ID column of type int(11), nullable
            $table->text('alt')->nullable(); // Alt column of type text, nullable
            $table->integer('sort')->nullable(); // Sort column of type int(11), nullable
            $table->text('link')->nullable(); // Link column of type text, nullable
            $table->boolean('is_enable')->default(1); // is_enable column of type int(11), default value 1
            $table->text('button')->nullable(); // Button column of type text, nullable
            $table->text('alignment')->nullable(); // Alignment column of type text, nullable
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
        Schema::dropIfExists('sliders');
    }
}

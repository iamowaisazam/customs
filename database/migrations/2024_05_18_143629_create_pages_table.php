<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id(); // Primary key with AUTO_INCREMENT
            $table->string('title'); // Title column of type string
            $table->string('slug')->unique(); // Slug column with unique constraint
            $table->text('shortdetails'); // Short details column of type text
            $table->text('longdetails'); // Long details column of type text
            $table->text('meta_title')->nullable(); // Meta title column of type text, nullable
            $table->text('meta_description')->nullable(); // Meta description column of type text, nullable
            $table->text('meta_keywords')->nullable(); // Meta keywords column of type text, nullable
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
        Schema::dropIfExists('pages');
    }
}

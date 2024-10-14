<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key with AUTO_INCREMENT
            $table->string('title', 255); // varchar(255)
            $table->string('slug', 255)->nullable(); // varchar(255), nullable
            $table->text('details')->nullable(); // text, nullable
            $table->integer('sort')->nullable(); // int(11), nullable
            $table->string('image_id', 255)->nullable(); // varchar(255), nullable
            $table->string('meta_title', 255)->nullable(); // varchar(255), nullable
            $table->text('meta_description')->nullable(); // text, nullable
            $table->text('meta_keywords')->nullable(); // text, nullable
            $table->integer('is_enable')->default(1); // int(11), defaults to 1
            $table->integer('is_featured')->default(0); // int(11), defaults to 0
            $table->timestamp('created_at')->useCurrent(); // timestamp, defaults to current timestamp
            $table->timestamp('updated_at')->useCurrent(); // timestamp, defaults to current timestamp
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collections');
    }
}

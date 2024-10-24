<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key with AUTO_INCREMENT
            $table->string('title', 255); // varchar(255)
            $table->string('slug', 255)->nullable(); // varchar(255), nullable
            $table->string('image', 255)->nullable(); // varchar(255), nullable
            $table->string('meta_title', 255)->nullable(); // varchar(255), nullable
            $table->text('meta_description')->nullable(); // text, nullable
            $table->text('meta_keywords')->nullable(); // text, nullable
            $table->timestamp('created_at')->useCurrent(); // timestamp, defaults to current timestamp
            $table->timestamp('updated_at')->useCurrent(); // timestamp, defaults to current timestamp
            $table->integer('is_enable')->default(1); // int(11), defaults to 1
            $table->integer('sort'); // int(11)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brands');
    }
}

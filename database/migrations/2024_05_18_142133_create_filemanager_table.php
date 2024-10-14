<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilemanagerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filemanager', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('title', 255); 
            $table->text('description')->nullable();
            $table->text('path')->nullable();
            $table->text('filename');
            $table->double('size')->nullable();
            $table->string('extension', 255);
            $table->string('type', 255); 
            $table->integer('created_by')->nullable();
            $table->timestamps();
            $table->integer('is_enable')->default(1);
            $table->text('grouping')->default('others');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filemanager');
    }
}

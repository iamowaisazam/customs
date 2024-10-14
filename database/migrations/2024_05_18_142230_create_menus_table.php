<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key with AUTO_INCREMENT
            $table->string('title', 255)->nullable(); // varchar(255) for title, nullable
            $table->string('slug', 255)->nullable(); // varchar(255) for slug, nullable
            $table->text('details')->nullable(); // text for details, nullable
            $table->integer('is_enable')->default(1); // int for is_enable with default value 1
            $table->timestamp('created_at')->useCurrent(); // created_at with default current timestamp
            $table->timestamp('updated_at')->useCurrent(); // updated_at with default current timestamp
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}

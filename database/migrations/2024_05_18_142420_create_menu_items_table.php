<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key with AUTO_INCREMENT
            $table->string('title', 255)->nullable(); // varchar(255) for title, nullable
            $table->string('subtitle', 255)->nullable(); // varchar(255) for subtitle, nullable
            $table->string('target', 255)->nullable(); // varchar(255) for target, nullable
            $table->text('link')->nullable(); // text for link, nullable
            $table->integer('level')->nullable(); // int for level, nullable
            $table->bigInteger('parent_id')->unsigned()->index()->nullable(); // bigint for parent_id with index, nullable
            $table->bigInteger('menu_id')->unsigned()->index()->nullable(); // bigint for menu_id with index, nullable
            $table->integer('sort')->default(0); // int for sort with default value 0
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
        Schema::dropIfExists('menu_items');
    }
}

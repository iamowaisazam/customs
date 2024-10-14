<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewslettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsletters', function (Blueprint $table) {
            $table->increments('id'); // Primary key with AUTO_INCREMENT
            $table->text('email')->nullable(); // Text column for email, nullable
            $table->integer('is_enable')->default(1); // Integer column for is_enable with default value 1
            $table->timestamp('created_at')->useCurrent()->useCurrentOnUpdate(); // Timestamp for created_at with current timestamp default and on update
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')); // Timestamp for updated_at with current timestamp default and on update
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('newsletters');
    }
}

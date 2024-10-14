<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->text('field');
            $table->text('value')->nullable();
            $table->text('type')->default('text');
            $table->integer('sort')->default(0);
            $table->text('grouping')->nullable();
            $table->integer('section_sorting')->default(0);
            $table->integer('group_sorting')->default(0);
            $table->text('section')->default('others');
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_intimations', function (Blueprint $table) {
            $table->id();
            $table->text('message')->nullable();
            $table->string('person_name')->nullable();
            $table->unsignedBigInteger('challan_id');
            $table->foreign('challan_id')->references('id')->on('delivery_challans')->onDelete('cascade');
            $table->integer('status')->default(1);
            $table->integer('created_by')->default(1);
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
        Schema::dropIfExists('delivery_intimiations');
    }
};

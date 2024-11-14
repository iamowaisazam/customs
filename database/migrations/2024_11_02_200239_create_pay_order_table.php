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
        
        Schema::create('payorders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consignment_id');
            $table->foreign('consignment_id')->references('id')->on('consignments')->onDelete('cascade');

            $table->text('consignment_details')->nullable();
            $table->text('footer')->nullable();
            $table->text('items')->nullable();
            $table->text('header')->nullable();


            $table->double('stan_duty')->default(0);
            $table->double('psw_fee')->default(0); 
            $table->double('eto')->default(0); 
            $table->double('drap_fee')->default(0); 
            
            $table->double('total')->default(0);
            

            $table->timestamp('date')->nullable();
            $table->integer('status')->default(1);
            $table->integer('created_by')->nullable();
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
        Schema::dropIfExists('pay_order');
    }
};

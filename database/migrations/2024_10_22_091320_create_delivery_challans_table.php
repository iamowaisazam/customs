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
        Schema::create('delivery_challans', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');

            $table->unsignedBigInteger('consignment_id');
            $table->foreign('consignment_id')->references('id')->on('consignments')->onDelete('cascade');

            $table->string('l_no')->nullable();
            $table->string('m_s')->nullable();
            $table->string('it_no')->nullable();  
            $table->string('lgnno')->nullable();    
            $table->string('invoice_no')->nullable();
            $table->string('invoice_date')->nullable();  
            $table->string('description')->nullable(); 
            $table->string('total_packages')->nullable();   
            $table->string('packages_delivered')->nullable();  
            $table->string('gross_wt')->nullable(); 
            $table->string('net_wt')->nullable(); 
            $table->string('bl_no')->nullable(); 
            $table->string('truck_no')->nullable();        
            $table->string('remarks')->nullable();  
            $table->string('consignee')->nullable();
                
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
        Schema::dropIfExists('delivery_challans');
    }
};

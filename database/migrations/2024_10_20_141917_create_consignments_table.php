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
        Schema::create('consignments', function (Blueprint $table) {
            $table->id();

            //Job
            $table->integer('job_number')->nullable();
            $table->string('job_number_prefix')->nullable();

            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->string('exporter')->nullable();
            
            $table->string('invoice_value')->nullable();
            $table->string('total_quantity')->nullable();
            $table->string('currency')->nullable();

            $table->integer('freight')->default(0);
            $table->integer('ins_rs')->default(0);
            $table->string('insurance_in_fc')->nullable();
            $table->integer('rate_of_exchange')->default(0);
            
            
            $table->string('blawbno')->nullable();
            $table->string('ttno')->nullable();
            $table->text('description')->nullable();
          
            $table->string('machine_number')->nullable();
            $table->timestamp('job_date')->nullable();
            $table->string('po_number')->nullable();
            $table->string('port')->nullable();
            $table->string('port_of_shippment')->nullable();
            $table->string('mode_of_shipment')->nullable();
            $table->string('eiffino')->nullable();
            $table->timestamp('lc_date')->nullable();
            $table->timestamp('igm_date')->nullable();
            $table->timestamp('bl_awb_date')->nullable();
            $table->integer('landing_charges')->default(0);
            $table->string('package_type')->nullable();
            $table->string('no_of_packages')->nullable();
            $table->string('index_no')->nullable();
            $table->timestamp('consignment_date')->nullable();
            $table->string('vessel')->nullable();
            $table->string('igmno')->nullable();
            $table->string('shipment_number')->nullable();
            $table->string('country_origion')->nullable();
            $table->string('master_agent')->nullable();
            $table->string('other_agent_agent')->nullable();
            $table->string('due_date')->nullable();
            $table->integer('gross')->default(0);
            $table->integer('nett')->default(0);
            $table->text('documents')->nullable();
            $table->integer('status')->default(1);
            $table->integer('created_by')->default(1);
            $table->timestamps();
        });


        Schema::create('consignments_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('consignment_id');
            $table->foreign('consignment_id')->references('id')->on('consignments')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('hs_code')->nullable();
            $table->double('price')->nullable();
            $table->double('qty')->nullable();
            $table->string('unit')->nullable();
            $table->double('total')->nullable();
            $table->integer('status')->default(1);

            $table->double('custom_duty')->default(0);
            $table->double('a_custom_duty')->default(0);
            $table->double('rd')->default(0);
            $table->double('it')->default(0);
            $table->double('saletax')->default(0);
            $table->double('a_saletax')->default(0);
            $table->double('after_duties')->default(0);

            
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
        Schema::dropIfExists('consignments');
    }
};

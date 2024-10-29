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

            $table->integer('job_number')->nullable();
            $table->string('job_number_prefix')->nullable();

            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->string('blawbno')->nullable();
            $table->string('lcbtitno')->nullable();
            $table->text('description')->nullable();
            $table->string('invoice_value')->nullable();
            $table->string('total_quantity')->nullable();
            $table->string('currency')->nullable();
            $table->string('machine_number')->nullable();
            $table->timestamp('job_date')->nullable();

            $table->string('your_ref')->nullable();
            $table->string('port')->nullable();
            $table->string('eiffino')->nullable();

            $table->string('import_exporter_messers')->nullable();
            $table->string('consignee_by_to')->nullable();
            $table->string('freight')->nullable();
            $table->string('ins_rs')->nullable();
            $table->string('us')->nullable();
            $table->string('lc_no')->nullable();

            $table->timestamp('lc_date')->nullable();
            $table->timestamp('igm_date')->nullable();
            $table->timestamp('bl_awb_date')->nullable();
            $table->string('landing_charges')->nullable();
            $table->string('no_of_packages')->nullable();
            $table->string('index_no')->nullable();
        

            $table->timestamp('consignment_date')->nullable();
            $table->string('vessel')->nullable();
            $table->string('igmno')->nullable();
            $table->string('port_of_shippment')->nullable();
            $table->string('country_origion')->nullable();
            $table->string('rate_of_exchange')->nullable();
            $table->string('master_agent')->nullable();
            $table->string('due_date')->nullable();
            $table->string('gross')->nullable();
            $table->string('nett')->nullable();



            $table->text('demands_received')->nullable();
            $table->text('documents')->nullable();

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
        Schema::dropIfExists('consignments');
    }
};

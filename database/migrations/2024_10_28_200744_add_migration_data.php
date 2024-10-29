<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        //

    
            //Port
            DB::table('settings')->insert([
                'field' => 'ports',
                'value' => json_encode([
                    '0001',
                    '0002',
                    '0003',
                ]),
            ]);


            DB::table('settings')->insert([
                'field' => 'port_of_shipment',
                'value' => json_encode([
                    '0001',
                    '0002',
                    '0003',
                ]),
            ]);

            DB::table('settings')->insert([
                'field' => 'documents',
                'value' => json_encode([
                    'document 1',
                    'document 2',
                    'document 3',
                ]),
            ]);


            //Import Export Company
            DB::table('settings')->insert([
                'field' => 'import_export_company',
                'value' => 'Import Company',
            ]);

            DB::table('settings')->insert([
                'field' => 'landing_charges',
                'value' => '100',
            ]);
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};

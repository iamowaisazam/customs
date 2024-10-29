<?php

namespace Database\Seeders;

use App\Enums\Currency;
use App\Models\Consignment;
use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Utilities\ConsigmentUtility;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

use Faker\Factory as Faker;


class ConsignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $faker = Faker::create();
        Consignment::select('*')->delete();

        foreach(range(1,500) as $key => $data){

            Consignment::create([
                "job_number" => ConsigmentUtility::get_job_number(),
                "job_number_prefix" => ConsigmentUtility::get_job_number().'/34-24',
                "customer_id" =>  Customer::inRandomOrder()->first()->id,
                "lcbtitno" =>  $faker->randomNumber(6),
                "description" => $faker->sentence,
                "total_quantity" => 10,
                "invoice_value" => $faker->randomFloat(2, 100, 10000),
                "currency" => 'USD',
                "machine_number" => $faker->randomNumber(6),
                "job_date" => $faker->dateTimeBetween('-1 year', 'now'),
                'status' => 1,
                'created_by' => User::where('status',1)->where('role_id',2)
                ->inRandomOrder()
                ->first()->id,
                'your_ref' => $faker->name,
                'port' => $faker->randomNumber(6),
                'eiffino' => 'eiffino',
                'import_exporter_messers' => 'messers',
                'consignee_by_to' => $faker->name,
                'freight' => $faker->randomNumber(6),
                'ins_rs' => 'ins_rs',
                'landing_charges' => 10,
                'us' => 'us',
                'lc_no' => $faker->randomNumber(6),
                'lc_date' => Carbon::now(),
                'vessel' => 'vessel',
                'igmno' => 'igmno',
                'igm_date' => Carbon::now(),
                "blawbno" => $faker->randomNumber(6),
                "bl_awb_date" => Carbon::now(),
                'port_of_shippment' => $faker->randomNumber(6),
                'country_origion' => 'Pakistan',
                'rate_of_exchange' => $faker->randomFloat(2, 100, 10000),
                'master_agent' => $faker->name,
                'due_date' => $faker->dateTimeBetween('-1 year', 'now'),
                'no_of_packages' => 1,
                'index_no' => 1,
                'gross' => $faker->randomFloat(2, 100, 10000),
                'nett' => $faker->randomFloat(2, 100, 10000),
                'documents' => json_encode([
                    [
                        'name' => 'Document 1',
                        'date' => Carbon::now(),
                    ],
                    [
                        'name' => 'Document 2',
                        'date' => Carbon::now(),
                    ]
                ]),
                'demands_received' => json_encode([
                    [
                        'title' => 'Title 1',
                        'hs_code' => 'Hs Code 1',
                        'qty' => 10,
                        'price' => 1,
                        'total' => 10,
                    ]
                ])
            ]);


        }


    }
}

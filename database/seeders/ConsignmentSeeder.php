<?php

namespace Database\Seeders;

use App\Enums\Currency;
use App\Models\Consignment;
use App\Models\Customer;
use App\Models\Exporter;
use App\Models\Product;
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


        foreach(range(1,20) as $key => $data){

            $job = ConsigmentUtility::create_job([
                "customer_id" =>  Customer::inRandomOrder()->first()->id,
                "exporter_id" =>  Exporter::inRandomOrder()->first()->id,
                "invoice_value" => 0,
                "total_quantity" => 0,
                "currency" => 'USD',
                "created_by" => User::where('status',1)->where('role_id',2)->inRandomOrder()->first()->id,
            ]);

            $total_quantity = 0;
            $invoice_value = 0;

            $items = [];
            foreach (range(1,3) as $value) {
                $product = Product::inRandomOrder()->first();
                $qty = $faker->randomNumber(2);
                array_push($items,[
                    'product_id' => $product->id,
                    'consignment_id' => $job->id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'price' => $product->price,
                    'qty' => $qty,
                    'unit' => $product->unit,
                    'total' => $product->price * $qty,
                ]);

                $total_quantity += $qty;
                $invoice_value += $product->price * $qty;
            }


            ConsigmentUtility::update_consignment_item($job->id,$items);
            $job->total_quantity = $total_quantity;
            $job->invoice_value = $invoice_value;
            $job->save();


            ConsigmentUtility::update_consignment($job->id,[
                "lcbtitno" =>  $faker->randomNumber(6),
                "description" => $faker->sentence,
                "machine_number" => $faker->randomNumber(6),
                "job_date" => $faker->dateTimeBetween('-1 year', 'now'),
                'your_ref' => $faker->name,
                
                'port' => $faker->randomNumber(6),
                'port_of_shippment' => $faker->randomNumber(6),

                'eiffino' => 'eiffino',
                'import_exporter_messers' => 'messers',
                
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
                
                'country_origion' => 'Pakistan',
                'rate_of_exchange' => $faker->randomFloat(2, 100, 10000),
                'master_agent' => $faker->name,
                'other_agent_agent' => $faker->name,
                'due_date' => $faker->dateTimeBetween('-1 year', 'now'),
                'package_type' => 'DRUM',
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
            ]);

           

        }

    
     





    }
}

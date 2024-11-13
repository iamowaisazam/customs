<?php

namespace Database\Seeders;

use App\Enums\Country;
use App\Enums\Currency;
use App\Enums\PackageType;
use App\Enums\Unit;
use App\Models\Consignment;
use App\Models\ConsignmentItem;
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
        ConsignmentItem::select('*')->delete();


        foreach(range(1,20) as $key => $data){
            
            $job = Consignment::create([
                "job_number" => ConsigmentUtility::get_job_number(),
                "job_number_prefix" => ConsigmentUtility::get_job_number_with_prefix(),
                "customer_id" =>  Customer::inRandomOrder()->first()->id,
                "exporter" =>  $faker->name,
                "invoice_value" => 0,
                "total_quantity" => 0,
                "currency" => 'USD',
                "job_date" => Carbon::now(),
                'freight' => $faker->randomNumber(2),
                'ins_rs' => $faker->randomNumber(2),
                'landing_charges' => 1,
                'rate_of_exchange' => $faker->randomNumber(2),
                'us' => 1,

                "lcbtitno" =>  $faker->randomNumber(2),
                "lcbtttno" =>  $faker->randomNumber(2),
                "machine_number" => $faker->randomNumber(6),
                'po_number' => $faker->name,
                'mode_of_shipment' => 'by-sea',
                'shipment_number' => $faker->randomNumber(2),
                
                'port' => collect(json_decode(ConsigmentUtility::get_setting('ports')))->random(),
                'port_of_shippment' => collect(json_decode(ConsigmentUtility::get_setting('ports')))->random(),
                'eiffino' => 'eiffino', 
                'lc_date' => Carbon::now(),
                'vessel' => 'vessel',
                'igmno' => 'igmno',
                'igm_date' => Carbon::now(),
                "blawbno" => $faker->randomNumber(6),
                "bl_awb_date" => Carbon::now(),
                'country_origion' => collect(Country::DATA)->random()['name'],
                'master_agent' => $faker->name,
                'other_agent_agent' => $faker->name,
                'due_date' => $faker->dateTimeBetween('-1 year', 'now'),
                'package_type' => collect(PackageType::DATA)->random(),
                'no_of_packages' => $faker->randomNumber(6),
                'index_no' => $faker->randomNumber(6),
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
                'status' => 1,
                "created_by" => User::where('status',1)->where('role_id',2)->inRandomOrder()->first()->id,
            ]);

                $total_qty = 0;
                $total = 0;
                foreach (range(1,3) as $value) {

                    $qty = $faker->randomNumber(2);
                    $price = $faker->randomNumber(2);
                    ConsignmentItem::create([
                        'consignment_id' => $job->id,
                        'name' => 'Name',
                        'hs_code' => $faker->randomNumber(6),
                        'price' => $faker->randomNumber(6),
                        'qty' => $qty,
                        'unit' => collect(Unit::DATA)->random(),
                        'total' => $price * $qty,
                    ]);
                    $total_qty += $qty;
                    $total += $price * $qty;
                }


                $job->invoice_value = $total;
                $job->total_quantity = $total_qty;
                $job->us = $job->ins_rs / $job-> rate_of_exchange;
                $job->save();

        }

        
        

    }








}

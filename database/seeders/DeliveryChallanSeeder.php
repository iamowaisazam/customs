<?php

namespace Database\Seeders;

use App\Enums\Currency;
use App\Models\Challan;
use App\Models\Consignment;
use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Utilities\ConsigmentUtility;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

use Faker\Factory as Faker;


class DeliveryChallanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();

        Challan::select('*')->delete();


        foreach(range(1,50) as $key => $data){

            Challan::create([
                "customer_id" =>  Customer::inRandomOrder()->first()->id,
                "consignment_id" => Consignment::inRandomOrder()->first()->id,
                "l_no" => $faker->randomNumber(6),
                "m_s" => $faker->randomNumber(6),
                "it_no" => $faker->randomNumber(6),
                "lgnno" => $faker->randomNumber(6),
                "invoice_no" => $faker->randomNumber(6),
                "invoice_date" => $faker->dateTimeBetween('-1 year', 'now'),
                "description" => "desc",
                "total_packages" => "total packages",
                "packages_delivered" => "Packages Delivered",
                "gross_wt" => "Gross",
                "net_wt" => " Net",
                "bl_no" => "bl_no",
                "truck_no" => "truck_no",
                "remarks" => "remarks",
                "consignee" => "consignee",
                "status" => 1,
                "created_by" => 1,
            ]);


        }


    }
}

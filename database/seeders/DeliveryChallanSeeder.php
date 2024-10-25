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
               
                "status" => 1,
                "created_by" => 1,
            ]);


        }


    }
}

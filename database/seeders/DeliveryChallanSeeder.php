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

        $consigments = Consignment::where('status',1)->limit(250)->get();

        foreach($consigments as $key => $consigment){

            Challan::create([
                "customer_id" => $consigment->customer_id,
                "consignment_id" => $consigment->id,
                "status" => 1,
                "created_by" => $consigment->created_by,
            ]);

        }


    }
}

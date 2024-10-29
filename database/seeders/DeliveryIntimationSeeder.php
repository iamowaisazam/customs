<?php

namespace Database\Seeders;

use App\Enums\Currency;
use App\Models\Challan;
use App\Models\Consignment;
use App\Models\Customer;
use App\Models\DeliveryIntimation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Utilities\ConsigmentUtility;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

use Faker\Factory as Faker;


class DeliveryIntimationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();

        DeliveryIntimation::select('*')->delete();
        $challans = Challan::select('*')->limit(200)->get();

        foreach($challans as $key => $chalan){

            DeliveryIntimation::create([
                'message' => 'Subject Consignment is Being Delivered While Other Info as Below',
                'person_name' => null,
                'challan_id' => $chalan->id,
                'status' => 1,
                'created_by' => $chalan->created_by,
                'created_at' => Carbon::now(),
            ]);

        }



    }
}

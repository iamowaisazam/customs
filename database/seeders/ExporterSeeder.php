<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Exporter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

use Faker\Factory as Faker;


class ExporterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();
    
        foreach(range(1,50) as $key => $data){

            $name =  $faker->name;
            $email = strtolower(str_replace(' ', '',$name)).'@gmail.com';

            Exporter::create([
                'company_name' => $faker->company,
                'name' => $name,
                'email' => $email,
                'phone' => $faker->phoneNumber,
                'status' => 1,
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);



        }


    }
}

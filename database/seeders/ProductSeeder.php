<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

use Faker\Factory as Faker;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();
        Product::select('*')->delete();

        foreach(range(1,100) as $key => $data){

            Product::create([
                'name' => $faker->company,
                'description' => $faker->sentence,
                'sku' => $faker->randomNumber(6),
                'unit' => 'PCS',
                'price' =>  $faker->randomNumber(2),
                'status' => 1,
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

        }


    }



}

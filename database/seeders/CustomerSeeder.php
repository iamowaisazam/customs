<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

use Faker\Factory as Faker;


class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();
        User::where('role_id',3)->delete();

        foreach(range(1,50) as $key => $data){

            $name =  $faker->name;
            $email = strtolower(str_replace(' ', '',$name)).'@gmail.com';
            $password = strtolower(str_replace(' ', '',$name));

            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'role_id' => 3,
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ]);

            Customer::create([
                'user_id' => $user->id,
                'company_name' => $faker->company,
                'customer_name' => $name,
                'customer_email' => $email,
                'customer_phone' => $faker->phoneNumber,
                'country' => 'Pakistan',
                'state' => 'Sindh',
                'city' => 'Karachi',
                'postal_code' =>  'code',
                'street_address' => $faker->address,
                'status' => 1,
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);


        }


    }
}

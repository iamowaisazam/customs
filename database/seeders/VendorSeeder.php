<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

use Faker\Factory as Faker;


class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();
        User::where('role_id',4)->delete();

        foreach(range(1,50) as $key => $data){

          
            $name =  $faker->name;
            $email = strtolower(str_replace(' ', '',$name)).'@gmail.com';
            $password = strtolower(str_replace(' ', '',$name));

            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'role_id' => 4,
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ]);

            Vendor::create([
                'user_id' => $user->id,
                'vendor_service' => $faker->bs,
                'vendor_name' => $name,
                'vendor_email' => $email,
                'vendor_phone' => $faker->phoneNumber,
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

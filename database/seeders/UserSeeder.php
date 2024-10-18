<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();

        User::where('role_id',2)->delete();

        foreach(range(1,50) as $key => $data){

            $name = $faker->name;

            $password = 'user'.$key;

            User::create([
                'name' => $name,
                'email' => strtolower(str_replace(' ','',$name)).'@gmail.com',
                'password' => Hash::make($password),
                'role_id' => 2,
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ]);
        }


    }
}

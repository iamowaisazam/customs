<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            UserSeeder::class,
            CustomerSeeder::class,
            VendorSeeder::class,
            // SiteSettingSeeder::class,
            // ProductSeeder::class,
            // SliderSeedar::class,
            // MenuSeeder::class,
            // PagesSeeder::class,
            // FilemanagerSeeder::class,
           
            // PaymentMethodsSeeder::class,
        ]);

        // \App\Models\User::factory(10)->create();
        // \App\Models\User::factory(10)->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\DeliveryIntimation;
use App\Models\Payorder;
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
            PermissionSeeder::class,
            CustomerSeeder::class,
            // ConsignmentSeeder::class,
            // PayorderSeeder::class,
            // DeliveryChallanSeeder::class,
            // DeliveryIntimationSeeder::class,
            // VendorSeeder::class,
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

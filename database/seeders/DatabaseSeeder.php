<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCollection;
use App\Models\Slider;
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
            CategorySubCategorySeeder::class,
            ProductCollectionSeeder::class,
            ProductSeeder::class,
            SliderSeedar::class,
            MenuSeeder::class,
            PagesSeeder::class,
            FilemanagerSeeder::class,
            SiteSettingSeeder::class,
            PaymentMethodsSeeder::class,
        ]);

        // \App\Models\User::factory(10)->create();
        // \App\Models\User::factory(10)->create();
    }
}

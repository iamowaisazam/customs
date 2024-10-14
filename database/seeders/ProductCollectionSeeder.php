<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Collection;

class ProductCollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $collectionsData = [
            [
                "id" => 6,
                "title" => "New Sale Offer",
                "slug" => "sale",
                "details" => "",
                "is_featured" => 1,
                'sort' => 1,
            ],
            [
                "id" => 1,
                "title" => "Mens",
                "slug" => "mens",
                "details" => "favourite pieces from Mens Collections",
                "is_featured" => 1,
                'sort' => 2,
            ],
            [
                "id" => 2,
                "title" => "Womens",
                "slug" => "womens",
                "details" => "favourite pieces from Womens Collections",
                "is_featured" => 1,
                'sort' => 3,
            ],
            [
                "id" => 3,
                "title" => "Kids",
                "slug" => "kids",
                "details" => "favourite pieces from Kids Collections",
                "is_featured" => 0,
                'sort' => 4,
            ],
            [
                "id" => 4,
                "title" => "Accessories",
                "slug" => "accessories",
                "details" => "favourite pieces from Accessories Collections",
                "is_featured" => 0,
                'sort' => 4,
            ],
            [
                "id" => 5,
                "title" => "shoes",
                "slug" => "shoes",
                "details" => "favourite pieces from Shoes Collections",
                "is_featured" => 0,
                'sort' => 4,
            ],
            
        ];

        $sortValue = 1;

        foreach ($collectionsData as $collection) {
            Collection::create([
                "id" => $collection['id'],
                "title" => $collection['title'],
                "slug" => $collection['slug'],
                "details" => $collection['details'],
                "is_enable" => 1,
                "is_featured" => $collection['is_featured'],
                "sort" => $collection['sort']
            ]);

            $sortValue++;
        }
    }
}

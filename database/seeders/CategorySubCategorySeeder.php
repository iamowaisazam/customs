<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         // category
         $categoriesData = [

            // 1 Parent Categories
            ["id" => 1, "title" => "Men's Fashion", "slug" => "mens-fashion" ,"image_id"=>"demo/cat_men.png","is_featured" => 1,
            "child" => [
                ["id" => 2, "title" => "T-Shirts", "slug" => "t-shirts"],
                ["id" => 3,"title" => "Mens Pants Trousers", "slug" => "mens-pants-trousers"],
                ["id" => 4,"title" => "Shoes", "slug" => "shoes"],
            ]],

             // 2 Parent Categories
            ["id" => 5, "title" => "Health & Beauty", "slug" => "health-beauty","image_id"=>"demo/cat_woman.png","is_featured" => 1,
            "child" => [
                ["id" => 6,"title" => "Makeup", "slug" => "makeup",],
                ["id" => 7,"title" => "Skin Care", "slug" => "skin-care"],
                ["id" => 8,"title" => "Beauty Tools", "slug" => "beauty-tools"],
            ]],


             // 3 Parent Categories
            ["id" => 9, "title" => "Women's Fashion", "slug" => "womens-fashion", "image_id"=>"demo/cat__woman2.png","is_featured" => 1,
            "child" =>[
                ["id" => 10,"title" => "Unstitched Fabric", "slug" => "unstitched-fabric"],
                ["id" => 11,"title" => "Kurtas & Shalwar Kameez", "slug" => "kurtas-shalwar-kameez"],
                ["id" => 12,"title" => "Tops", "slug" => "tops",],
             ]
            ],


            // 4 Parent Categories
            ["id" => 13, "title" => "Mother & Baby", "slug" => "mother-baby","image_id"=>"demo/cat__woman2.png","is_featured" => 1, 
            "child" => [
                ["id" => 14,"title" => "Milk Formula", "slug" => "milk-formula"],
                ["id" => 15,"title" => "Diapering & Potty", "slug" => "diapering-potty"],
                ["id" => 16,"title" => "Feeding", "slug" => "feeding"],
            ]],
          

            // 5 Parent Categories
            ["id" => 17,"title" => "Groceries & Pets", "slug" => "groceries-pets", "image_id"=>"demo/Groceries_Pets.png","is_featured" => 1,
            "child" => [
                ["id" => 18,"title" => "Fresh Produce", "slug" => "fresh-produce"],
                ["id" => 19,"title" => "Breakfast", "slug" => "breakfast"],
                ["id" => 20,"title" => "Beverages", "slug" => "beverages"],
            ]],


             // 6 Parent Categories
            ["id" => 21, "title" => "Home & Lifestyle", "slug" => "home-lifestyle", "image_id"=>"demo/HomeLifestyle.png","is_featured" => 1,
            "child" => [
                ["id" => 22,"title" => "Bath", "slug" => "bath"],
                ["id" => 23,"title" => "Bedding", "slug" => "bedding"],
                ["id" => 24,"title" => "Furniture", "slug" => "furniture"],
            ]],


            // 7 Parent Categories
            ["id" => 25 , "title" => "Electronic Devices", "slug" => "electronic-devices", "image_id"=>"","is_featured" => 0,
            "child" => [
              ["id" => 26,"title" => "Laptops", "slug" => "laptops"],
              ["id" => 27,"title" => "Monitors", "slug" => "monitors"],
              ["id" => 28,"title" => "Mobiles", "slug" => "mobiles"],
            ]],


            // 8 Parent Categories
            ["id" => 29,"title" => "Electronic Accessories", "slug" => "electronic-accessories", "image_id"=>"","is_featured" => 0, "child" =>[
             ["id" => 30,"title" => "Mobile Accessories", "slug" => "mobile-accessories"],
             ["id" => 31,"title" => "Headphones & Headsets", "slug" => "headphones-headsets"],
             ["id" => 32,"title" => "Wearable Technology", "slug" => "wearable-technology"],
            ]],


            // 9 Parent Categories
            ["id" => 33, "title" => "TV & Home Appliances", "slug" => "tv-home-appliances", "image_id"=>"","is_featured" => 0, "child" => [
                ["id" => 34,"title" => "Air Conditioners", "slug" => "air-conditioners"],
                ["id" => 35,"title" => "Televisions", "slug" => "televisions"],
                ["id" => 36,"title" => "Refrigerators", "slug" => "refrigerators"],
            ]],


            // 10 Parent Categories
            ["id" => 37, "title" => "Sports & Outdoor", "slug" => "sports-o","image_id"=>"","is_featured" => 0,"child" => [
                ["id" => 38,"title" => "Exercise & Fitness", "slug" => "exercise-fitness"],
                ["id" => 39,"title" => "Sports Nutrition", "slug" => "sports-nutrition"],
                ["id" => 40,"title" => "Team Sports", "slug" => "team-sports"],
            ]],

        ];

        // Insert categories data
        foreach ($categoriesData as $categoryData) {

            Category::create([
                "id" => $categoryData['id'], 
                "title" => $categoryData['title'], 
                "slug" => $categoryData['slug'], 
                "image_id" => $categoryData['image_id'], 
                "is_featured" => $categoryData['is_featured'], 
                "parent_id" => NULL, 
                "is_enable" => 1
            ]);

            foreach ($categoryData['child'] as $child) {
                Category::create([
                    "id" => $child['id'], 
                    "title" => $child['title'], 
                    "slug" => $child['slug'], 
                    "parent_id" => $categoryData['id'], 
                    "is_enable" => 1
                ]);
            }


        }

    }
}

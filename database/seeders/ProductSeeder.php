<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductCollection;
use App\Models\Value;
use App\Models\Variation;
use App\Models\VariationAttribute;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Order Process
        OrderStatus::create([
            'id' => 1,
            'title' => 'Pending',
            'is_enable' => 1, 
        ]);

        OrderStatus::create([
            'id' => 2,
            'title' => 'Approved',
            'is_enable' => 1, 
        ]);

        OrderStatus::create([
            'id' => 3,
            'title' => 'Cancel',
            'is_enable' => 1, 
        ]);

        OrderStatus::create([
            'id' => 5,
            'title' => 'Delivery Process',
            'is_enable' => 1, 
        ]);

        OrderStatus::create([
            'id' => 6,
            'title' => 'Complete',
            'is_enable' => 1, 
        ]);



        // attributes
        $attributesData = [
            [
                'title' => 'size', 
                'is_enable' => 1,
                'values' => [
                    'xl','l','m','s','24','26','28','30','20','22','1','2','3','4'
                ],
            ],
            [
                'title' => 'color', 
                'is_enable' => 1,
                'values' => [
                    'red','blue','green','pink','white','black','brown',
                    'dark brown'
                ]
            ],
        ];

        // Insert attributes data
        foreach ($attributesData as $attribute) {
            $a = Attribute::create([
                'title' => $attribute['title'], 
                'is_enable' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            foreach ($attribute['values'] as $value) {
                Value::create([
                    'title' => $value, 
                    'attribute_id' => $a->id,
                    // 'is_enable' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }



       //Products Data
       $productData =[
        [
            "id" => 1,
            "title" => "Men’s Denim sky blue jeans",
            "slug" => "men-s-denim-sky-blue-jeans",
            "sku" => ["xl-red","l-blue"],
            'image'=>'demo/pent.jpeg',
            'images'=>'demo/pent.jpeg',
            'hover_image'=>'demo/pent_hver.jpeg',
            "price" => 1449,
            "selling_price" => 1549,
            "category_id" => 1,
            "product_collections"=>[1,2,5]
        ],
        [
            "id" => 2,
            "title" => "cotton stylish shortstops",
            "slug" => "cotton-stylish-shirtstops",
            "sku" => ["xl-red","l-blue"],
            'image'=>'demo/GirlsShortsSummer.jpeg',
            'images'=>'demo/GirlsShortsSummer.jpeg',
            'hover_image'=>'demo/GirlsShortsSummer_hover.jpeg',
            "price" => 2000,
            "selling_price" => 2500,
            "category_id" => 11,
            "product_collections"=>[3,4]
            ],
            [
                "id" => 3,
                "title" => "Girls Ladies Stylish Fashion Classy Neck Top",
                "slug" => "girls-ladies-stylish-fashion-classsy-neck-top",
                "sku" => ["xl-red","l-blue"],
                'image'=>'demo/kurti.jpeg',
                'images'=>'demo/kurti.jpeg',
                'hover_image'=>'demo/kurti_hover.jpeg',
                "price" => 1400,
                "selling_price" => 2000,
                "category_id" => 11,
                "product_collections"=>[3,2]
            ],
            [
                "id" => 4,
                "title" => "Girls Shorts Summer",
                "slug" => "girls-shorts-summer",
                "sku" => ["xl-red","l-blue"],
                'image'=>'demo/cottonstylishshortstops.jpeg',
                'images'=>'demo/cottonstylishshortstops.jpeg',
                'hover_image'=>'demo/cottonstylishshortstops_hover.jpeg',
                "price" => 1000,
                "selling_price" => 13,
                "category_id" => 11,
                "product_collections"=>[3,1,4]
            ],
            [
                "id" => 5,
                "title" => "Glow & Handsome Face Cream Instant Brightness 100g",
                "slug" => "glow-handsome-face-cream-instant-brightness-100g",
                "sku" => ["xl-red","l-blue"],
                'image'=>'demo/cream2.jpeg',
                'images'=>'demo/cream2.jpeg',
                'hover_image'=>'demo/cream2_hover.jpeg',
                "price" => 200,
                "selling_price" => 280,
                "category_id" => 1,
                "product_collections"=>[1,2,3,5]
            ],
            [
                "id" => 6,
                "title" => "Glow & Handsome Face Cream",
                "slug" => "glow-handsome-face-cream",
                "sku" => ["xl-red","l-blue"],
                'image'=>'demo/cream.jpeg',
                'images'=>'demo/cream.jpeg',
                'hover_image'=>'demo/cream_hover.jpeg',
                "price" => 300,
                "selling_price" => 480,
                "category_id" => 5,
                "product_collections"=>[1,2,6]
            ],
            [
                "id" => 7,
                "title" => "Joefox new men's watch",
                "slug" => "joefox-new-men-s-watch",
                "sku" => ["xl-red","l-blue"],
                'image'=>'demo/watch1.jpeg',
                'images'=>'demo/watch1.jpeg',
                'hover_image'=>'demo/watch1_hover.jpeg',
                "price" => 6000,
                "selling_price" => 7000,
                "category_id" => 1,
                "product_collections"=>[1,2,3,5,6]
            ],
            [
                "id" => 8,
                "title" => "Joefox men's watch",
                "slug" => "joefox-men-s-watch",
                "sku" => ["xl-red","l-blue"],
                'image'=>'demo/watch2.jpeg',
                'images'=>'demo/watch2.jpeg',
                'hover_image'=>'demo/watch2_hover.jpeg',
                "price" => 15000,
                "selling_price" => 17000,
                "category_id" => 1,
                "product_collections"=>[1,4,2]
            ],
            [
                "id" => 9,
                "title" => "White Liner Blue Jacket, front open zipper type - Stylish and Versatile Outerwear for Men Premium quality",
                "slug" => "white-liner-blue-jacket-front-open-zipper-type-stylish-and-versatile-outerwear-for-men-premium-quality",
                "sku" => ["xl-red","l-blue"],
                'image'=>'demo/bluejacket.jpeg',
                'images'=>'demo/bluejacket.jpeg',
                'hover_image'=>'demo/bluejacket_hover.jpeg',
                "price" => 3000,
                "selling_price" => 3500,
                "category_id" => 1,
                "product_collections"=>[4,5,3,1]
            ],
            [
                "id" => 10,
                "title" => "Black Sleeve Zipper Style Jacket For Men",
                "slug" => "black-sleeve-zipper-style-jacket-for-men",
                "sku" => ["xl-red","l-blue"],
                'image'=>'demo/blackacket.jpeg',
                'images'=>'demo/blackacket.jpeg',
                'hover_image'=>'demo/blackjacket_hover.jpeg',
                "price" => 3000,
                "selling_price" => 3500,
                "category_id" => 1,
                "product_collections"=>[1,5,4,6]
            ],
            [
                "id" => 11,
                "title" => "Woman ring",
                "slug" => "woman-ring",
                "sku" => ["xl-red","l-blue"],
                'image'=>'demo/ring.png',
                'images'=>'demo/ring.png',
                'hover_image'=>'demo/ring_hover.png',
                "price" => 500,
                "selling_price" => 900,
                "category_id" => 9,
                "product_collections"=>[2,1,4]
            ],
            [
                "id" => 12,
                "title" => "Girl Wonderful Smoke Tube Lipstick | Pack Of 4",
                "slug" => "girl-wonderful-smoke-tube-lipstick-pack-of-4",
                "sku" => ["xl-red","l-blue"],
                'image'=>'demo/makeup.png',
                'images'=>'demo/makeup.png',
                'hover_image'=>'demo/makeup_hover.png',
                "price" => 700,
                "selling_price" => 900,
                "category_id" => 6,
                "product_collections"=>[2,5]
            ],
            [
                "id" => 13,
                "title" => "Omega 3 Fish Oil 90 Caps",
                "slug" => "omega-3-fish-oil-90-caps",
                "sku" => ["xl-red","l-blue"],
                'image'=>'demo/omega.png',
                'images'=>'demo/omega.png',
                'hover_image'=>'demo/omega_hover.png',
                "price" => 4700,
                "selling_price" => 4900,
                "category_id" => 39,
                "product_collections"=>[6,3,4]    
            ],
            [
                "id" => 14,
                "title" => "Lenovo Core i5 3rd Generation | 8GB Ram , 500GB Hard Drive",
                "slug" => "lenovo-core-i5-3rd-generation-8gb-ram-500gb-hard-drive",
                "sku" => ["xl-red","l-blue"],
                'image'=>'demo/laptop1.png',
                'images'=>'demo/laptop1.png',
                'hover_image'=>'demo/laptop1_hover.png',
                "price" => 70000,
                "selling_price" => 90000,
                "category_id" => 26,
                "product_collections"=>[6,1,2]
            ],

       ];
       foreach($productData as $product){
        $p = Product::create([
            "id" => $product['id'],
            "title" => $product['title'],
            "slug" => $product['slug'],
            "sku" => $product['sku'][0],
            'image'=>$product['image'],
            'images'=>$product['images'],
            'hover_image'=>$product['hover_image'],
            "price" => $product['price'],
            "selling_price" => $product['selling_price'],
            "category_id" => $product['category_id'],
            "is_featured" => 1,
            'is_enable'=> 1,
            "description" => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry`s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </p>',
        ]);

        foreach ($product['product_collections'] as $product_collections) {
            ProductCollection::create([
                'product_id'=> $product['id'],
                'collection_id'=> $product_collections,
                'is_enable'=> 1
            ]);
        }
        

        foreach ($product['sku'] as $sku) {

            $v = Variation::create([
                'product_id' => $p->id,
                'sku' => $sku,
                'quantity' => 5,
                'price' => $p->price,
                'image' => $p->image,
            ]);
    
            $skuArray = explode('-',$v->sku);
            foreach($skuArray as $value){
                VariationAttribute::create([
                    'variation_id' => $v->id,
                    'attribute_id' =>Value::where('title',$value)->first()->attribute_id,
                    'value_id' => Value::where('title',$value)->first()->id,
                    'value' => $value,
                ]);
            }

        }

  
        
     }
  }

}

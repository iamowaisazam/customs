<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Slider;

class SliderSeedar extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $silderData=[
            [
                'title'=>'New Fashion style',
                'details' => 'We design and developed theme that are amazingly Unique',
                'image_id'=>'demo/slider1.jpg',
                'link'=>'/shop',
            ],
            [
                'title'=>'Beautiful Designs',
                'details' => 'The Website is all you need to build outstanding online shop',
                'image_id'=>'demo/slider2.jpg',
                'link'=>'/shop',
            ],
            [
                'title'=>'Inhale Designs',
                'details' => 'Special discount for this month Flat 30% Off',
                'image_id'=>'demo/slider3.jpg',
                'link'=>'/shop',
            ]
        ];
        $i =1;
        foreach($silderData as $silder){
            Slider::create([
                'title'=>$silder['title'],
                'details'=>$silder['details'] ?? '',
                'image_id'=>$silder['image_id'],
                'link'=>$silder['link'],
                'is_enable'=>1,
                'button'=>'Shop Now',
                'sort'=>$i
            ]);
            $i ++;
        }
    }
}

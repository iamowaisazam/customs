<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $data = [
            "site_title" => "MSTORE",
            "meta_title" => "MSTORE",
            "meta_description" => "MSTORE is fully customizable and appearing to your customers in accordance with what they need and what they search",
            "meta_keywords" => "MSTORE is fully customizable and appearing to your customers in accordance with what they need and what they search",
            "footer_credits" => 'Copyright: 2024 <a href="#."><span class="color_red">MSTORE</span></a>',
            "phone_number" => '03112239342',
            "email_address" => 'lara@commerce.com',
            "address" => "Address Will come here.",
            "domain" => "www.laracommerce.com",
            "logo" =>"demo/logo.png", 
            "fav_icon" => "demo/favicon.png",
            "facebook_link" => "#",
            "youtube_link" => "#",
            "twitter_link" => "",
            "instagram_link" => "",
            "admin_logo" => "",
            "admin_favicon" => "",
            "site_currency" => "PKR",
            "topbar_title" => "Welcome To MSTORE",
            "site_short_details" => "MSTORE is fully customizable and appearing to your customers in accordance with what they need and what they search Be a star of your own dream. Start your own ecommerce business right now!",
            "delivery_charges" => 200,
            "home_page_banner" => "demo/banner1.jpg",
            "home_page_text" => "MSTORE",
            "home_page_text_color" => "white",
            "home_page_details" => "WE ENJOY WORKING ON THE SERVICES & PRODUCTS. WE PROVIDE AS MUCH AS YOU NEED THEM. THIS HELP US IN DELIVERING YOUR GOALS EASILY. BROWSE THROUGH THE WIDE RANGE OF SERVICES WE PROVIDE.",
            "menu_type" => "left",
            "shop_banner" => "demo/shopbanner.jpg",
        ];
        
        foreach ($data as $key => $value) {
            Setting::where('field',$key)->update(["value" => $value]);
        }
        
    }
}

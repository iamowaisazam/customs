<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('settings')->insert([
            ['field' => 'site_title', 'value' => 'Website Name', 'type' => 'text', 'sort' => 1, 'grouping' => 'general', 'section_sorting' => 0, 'group_sorting' => 0, 'section' => 'others'],
            ['field' => 'meta_title', 'value' => 'Meta Title', 'type' => 'text', 'sort' => 2, 'grouping' => 'seo', 'section_sorting' => 0, 'group_sorting' => 0, 'section' => 'seo'],
            ['field' => 'meta_description', 'value' => 'meta_description', 'type' => 'text', 'sort' => 3, 'grouping' => 'seo', 'section_sorting' => 0, 'group_sorting' => 0, 'section' => 'seo'],
            ['field' => 'meta_keywords', 'value' => 'meta_keywords,meta_keywords', 'type' => 'text', 'sort' => 4, 'grouping' => 'seo', 'section_sorting' => 0, 'group_sorting' => 0, 'section' => 'seo'],
            
            ['field' => 'footer_credits', 'value' => 'Copyright: 2024 <a href="#."><span class="color_red">Lara commerce</span></a>', 'type' => 'text', 'sort' => 5, 'grouping' => 'theme', 'section_sorting' => 3, 'group_sorting' => 0, 'section' => 'footer'],
            ['field' => 'phone_number', 'value' => '+92000000000', 'type' => 'text', 'sort' => 5, 'grouping' => 'general', 'section_sorting' => 0, 'group_sorting' => 0, 'section' => 'others'],
            ['field' => 'email_address', 'value' => 'admin@admin.com', 'type' => 'text', 'sort' => 4, 'grouping' => 'general', 'section_sorting' => 0, 'group_sorting' => 0, 'section' => 'others'],
            ['field' => 'address', 'value' => 'Address Will come here.', 'type' => 'text', 'sort' => 4, 'grouping' => 'general', 'section_sorting' => 0, 'group_sorting' => 0, 'section' => 'others'],
            ['field' => 'domain', 'value' => 'www.yourdomain.com', 'type' => 'text', 'sort' => 4, 'grouping' => 'general', 'section_sorting' => 0, 'group_sorting' => 0, 'section' => 'others'],
     
            ['field' => 'admin_logo', 'value' => 'www.yourdomain.com', 'type' => 'image', 'sort' => 4, 'grouping' => 'admin_settings', 'section_sorting' => 0, 'group_sorting' => 0, 'section' => 'others'],
            ['field' => 'admin_favicon', 'value' => 'www.yourdomain.com', 'type' => 'image', 'sort' => 4, 'grouping' => 'admin_settings', 'section_sorting' => 0, 'group_sorting' => 0, 'section' => 'others'],
            ['field' => 'site_currency', 'value' => 'PKR', 'type' => 'text', 'sort' => 5, 'grouping' => 'shop_settings', 'section_sorting' => 0, 'group_sorting' => 0, 'section' => 'shop'],
            
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};

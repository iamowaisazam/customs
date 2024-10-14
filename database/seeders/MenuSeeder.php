<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\MenuItem;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menusData = [
            [
                'title' => 'main menu',
                'slug' => 'main-menu',
                'menuItem'=>[
                    [
                        'title' => 'Home',
                        'link' => '/',
                    ],
                    [
                        'title' => 'Shop',
                        'link' => 'shop',
                    ],
                    [
                        'title' => 'Men',
                        'link' => '/shop?category=mens-fashion',
                        'child' => [
                            ['title' => 'T-Shirts', 'link' => '/shop?category=t-shirts'],
                            ['title' => 'Mens Pants Trousers', 'link' => '/shop?category=mens-pants-trousers'],
                            ['title' => 'Shoes', 'link' => '/shop?category=shoes'],
                        ],
                    ],
                    [
                        'title' => 'Women',
                        'link' => '/shop?category=womens-fashion',
                        'child' => [
                            ['title' => 'Unstitched Fabric', 'link' => '/shop?category=unstitched-fabric'],
                            ['title' => 'Kurtas & Shalwar Kameez', 'link' => '/shop?category=kurtas-shalwar-kameez'],
                            ['title' => 'Tops', 'link' => '/shop?category=tops'],
                        ],
                    ],
                    [
                        'title' => 'Health & Beauty',
                        'link' => '/shop?category=health-beauty',
                        'child' => [
                            ['title' => 'Makeup', 'link' => '/shop?category=unstitched-fabric'],
                            ['title' => 'Skin Care', 'link' => '/shop?category=skin-care'],
                            ['title' => 'Beauty Tools', 'link' => '/shop?category=beauty-tools'],
                        ],
                    ],
                    [
                        'title' => 'Mother & Baby',
                        'link' => '/shop?category=mother-baby',
                        'child' => [
                            ['title' => 'Milk Formula', 'link' => '/shop?category=milk-formula'],
                            ['title' => 'Diapering & Potty', 'link' => '/shop?category=diapering-potty'],
                            ['title' => 'Feeding', 'link' => '/shop?category=feeding'],
                        ],
                    ],
                    [
                        'title' => 'Home & Lifestyle',
                        'link' => '/shop?category=home-lifestyle',
                        'child' => [
                            ['title' => 'Bath', 'link' => '/shop?category=bath'],
                            ['title' => 'Bedding', 'link' => '/shop?category=bedding'],
                            ['title' => 'Furniture', 'link' => '/shop?category=furniture'],
                        ],
                    ],
                    [
                        'title' => 'Electronic Devices',
                        'link' => '/shop?category=electronic-devices',
                        'child' => [
                            ['title' => 'Laptops', 'link' => '/shop?category=laptops'],
                            ['title' => 'Monitors', 'link' => '/shop?category=monitors'],
                            ['title' => 'Mobiles', 'link' => '/shop?category=mobiles'],
                        ],
                    ],

                ]
            ],
            [
                'title' => 'Footer Menu 1',
                'slug' => 'footer-menu-1',
                'menuItem'=>[
                    [
                        'title' => 'About Us',
                        'link' => '/pages/about-us',
                    ],
                    [
                        'title' => 'Order Tracking',
                        'link' => '/order-tracking',
                    ],
                    [
                        'title' => 'FAQs',
                        'link' => '/pages/faq',
                    ],
                    [
                        'title' => 'Contact Us',
                        'link' => '/pages/contact-us',
                    ],
                    // [
                    //     'title' => 'Order Process',
                    //     'link' => '/pages/order-process',
                    // ],
                ]
            ],
            [
                'title' => 'Footer Menu 2',
                'slug' => 'footer-menu-2',
                'menuItem'=>[
                    [
                        'title' => 'Shipping Policy',
                        'link' => '/pages/shipping-policy',
                    ],
                    [
                        'title' => 'Returns & Exchange',
                        'link' => '/pages/exchange-and-return-policy',
                    ],
                    [
                        'title' => 'Privacy Policy',
                        'link' => '/pages/privacy-policy',
                    ],
                    [
                        'title' => 'Terms & condition',
                        'link' => '/pages/terms-conditions',
                    ],
                ]
            ],
        ];

        foreach ($menusData as $menu) {
            $newMenu = Menu::create([
                'title' => $menu['title'],
                'slug' => $menu['slug'],
                'is_enable' => 1,
            ]);

            foreach ($menu['menuItem'] as $menuItem) {
                $newMenuItem = MenuItem::create([
                    'title' => $menuItem['title'],
                    'link' => $menuItem['link'],
                    'level' => 1,
                    'parent_id' => null,
                    'menu_id' => $newMenu->id,
                    'is_enable' => 1,
                ]);

                if (isset($menuItem['child'])) {
                    foreach ($menuItem['child'] as $submenu) {
                        MenuItem::create([
                            'title' => $submenu['title'],
                            'link' => $submenu['link'],
                            'level' => 2,
                            'parent_id' => $newMenuItem->id,
                            'menu_id' => $newMenu->id,
                            'is_enable' => 1,
                        ]);
                    }
                }
            }
        }
    }
}

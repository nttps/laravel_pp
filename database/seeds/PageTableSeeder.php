<?php

use Illuminate\Database\Seeder;
use NttpsApp\Models\Page;
use NttpsApp\Models\PageTranslation;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        $seo_meta[] = [
            "seo_title" => null,
            "seo_keywords" => null,
            "seo_description" => null
        ];

        $banners = [
            [
                "image" => 'banner.jpg',
                "link" => null,
            ],
            [
                "image" => 'banner.jpg',
                "link" => null,
            ]
        ];

        $pages = [
            ['name' => 'about-us', 'slug' => 'about-us', 'seo_meta' => $seo_meta, 'is_page_products' => '0', 'banner_header' => $banners],
            ['name' => 'contact', 'slug' => 'contact', 'seo_meta' => $seo_meta, 'is_page_products' => '0', 'banner_header' => $banners],
            ['name' => 'collection', 'slug' => 'collection', 'seo_meta' => $seo_meta, 'is_page_products' => '1', 'banner_header' => $banners],
            ['name' => 'gift', 'slug' => 'gift', 'seo_meta' => $seo_meta, 'is_page_products' => '1', 'banner_header' => $banners],
            ['name' => 'thai-amulet', 'slug' => 'thai-amulet', 'seo_meta' => $seo_meta, 'is_page_products' => '1', 'banner_header' => $banners],
            ['name' => 'privacy-policy', 'slug' => 'privacy-policy', 'seo_meta' => $seo_meta, 'is_page_products' => '0', 'banner_header' => $banners],
            ['name' => 'term-conditions', 'slug' => 'term-conditions', 'seo_meta' => $seo_meta, 'is_page_products' => '0', 'banner_header' => $banners],
            

        ];
        foreach ($pages as $page) {
            $createpage = Page::create($page);

            $pageTranslation = [
                ['display_name' => strtoupper(str_replace("-", " ", $createpage->name)), 'locale' => 'th', 'page_id' => $createpage->id],
                ['display_name' => strtoupper(str_replace("-", " ", $createpage->name)), 'locale' => 'en', 'page_id' => $createpage->id],
                ['display_name' => strtoupper(str_replace("-", " ", $createpage->name)), 'locale' => 'cn', 'page_id' => $createpage->id],
            ];

            PageTranslation::insert($pageTranslation);
        }
    }
}

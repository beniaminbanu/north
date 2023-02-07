<?php

namespace Database\Seeders;

use App\Models\PageData;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PagesDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        PageData::truncate();
        $json = File::get(base_path("database/seeders/json/pages_data.json"));
        $pagesData = json_decode($json, true);
        foreach ($pagesData as $pageData) {
            PageData::create([
                'page_id' => $pageData['page_id'],
                'locale' => $pageData['locale'],
                'slug' => $pageData['slug'],
                'seo_title' => $pageData['seo_title'],
                'seo_description' => $pageData['seo_description'],
                'seo_keywords' => $pageData['seo_keywords'],
                'name' => $pageData['name'],
                'short_description' => $pageData['short_description'],
                'description' => $pageData['description'],
                'link' => $pageData['link'],
                'heading' => $pageData['heading']
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}

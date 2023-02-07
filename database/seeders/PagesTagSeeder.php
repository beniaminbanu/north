<?php

namespace Database\Seeders;

use App\Models\PageTag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PagesTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        PageTag::truncate();
        $json = File::get(base_path("database/seeders/json/pages_tags.json"));
        $pagesTags = json_decode($json, true);
        foreach ($pagesTags as $pageTag) {
            PageTag::create([
                'name' => $pageTag['name']
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}

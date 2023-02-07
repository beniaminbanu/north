<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PagesToTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('pages_to_tags')->truncate();
        $json = File::get(base_path("database/seeders/json/pages_to_tags.json"));
        $pagesToTags = json_decode($json, true);
        foreach ($pagesToTags as $pageToTag) {
            DB::table('pages_to_tags')->insert([
                'page_id' => $pageToTag['page_id'],
                'tag_id' => $pageToTag['tag_id']
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}

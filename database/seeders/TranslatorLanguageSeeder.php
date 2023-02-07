<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class TranslatorLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('translator_languages')->truncate();
        $json = File::get(base_path("database/seeders/json/translator_languages.json"));
        $pages = json_decode($json, true);
        foreach ($pages as $page) {
            DB::table('translator_languages')->insert([
                'locale' => $page['locale'],
                'name' => $page['name'],
                'deleted_at' => $page['deleted_at']
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}

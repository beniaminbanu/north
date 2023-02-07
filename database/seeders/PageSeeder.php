<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Page::truncate();
        $json = File::get(base_path("database/seeders/json/pages.json"));
        $pages = json_decode($json, true);
        foreach ($pages as $page) {
            Page::create([
                'handler_controller' => $page['handler_controller'],
                'handler_view' => $page['handler_view'],
                'handler_action' => $page['handler_action'],
                'class' => $page['class'],
                'order' => $page['order'],
                'parent_id' => $page['parent_id'],
                'image' => $page['image'],
                'is_searchable' => $page['is_searchable']
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}

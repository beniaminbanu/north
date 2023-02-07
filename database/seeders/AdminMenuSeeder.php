<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AdminMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('admin_menu')->truncate();
        $json = File::get(base_path("database/seeders/json/admin_menu.json"));
        $items = json_decode($json, true);
        foreach ($items as $item) {
            DB::table('admin_menu')->insert([
                'parent_id' => $item['parent_id'],
                'order' => $item['order'],
                'title' => $item['title'],
                'icon' => $item['icon'],
                'uri' => $item['uri']
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}

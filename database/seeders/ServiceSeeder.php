<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Service::truncate();
        $json = File::get(base_path("database/seeders/json/services.json"));
        $services = json_decode($json, true);
        foreach ($services as $service) {
            Service::create([
                'image' => $service['image'],
                'order' => $service['order'],
                'is_home' => $service['is_home'],
                'status' => $service['status'],
                'is_footer' => $service['is_footer'],
                'footer_order' => $service['footer_order'],
                'is_request' => $service['is_request'],
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}

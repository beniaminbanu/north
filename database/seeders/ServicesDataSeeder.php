<?php

namespace Database\Seeders;

use App\Models\ServiceData;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ServicesDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        ServiceData::truncate();
        $json = File::get(base_path("database/seeders/json/services_data.json"));
        $servicesData = json_decode($json, true);
        foreach ($servicesData as $serviceData) {
            ServiceData::create([
                'service_id' => $serviceData['service_id'],
                'locale' => $serviceData['locale'],
                'slug' => $serviceData['slug'],
                'seo_title' => $serviceData['seo_title'],
                'seo_description' => $serviceData['seo_description'],
                'seo_keywords' => $serviceData['seo_keywords'],
                'name' => $serviceData['name'],
                'title' => $serviceData['title'],
                'short_description' => $serviceData['short_description'],
                'description' => $serviceData['description'],
                'list' => $serviceData['list']
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}

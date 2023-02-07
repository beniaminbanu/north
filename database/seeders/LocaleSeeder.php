<?php

namespace Database\Seeders;

use App\Models\Locale;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class LocaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Locale::truncate();
        $json = File::get(base_path("database/seeders/json/locales.json"));
        $locales = json_decode($json, true);
        foreach ($locales as $locale) {
            Locale::create([
                'locale' => $locale['locale'],
                'name' => $locale['name'],
                'native' => $locale['native'],
                'regional' => $locale['regional'],
                'default' => $locale['default'],
                'status' => $locale['status']
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}

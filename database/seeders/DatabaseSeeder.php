<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LocaleSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(PagesDataSeeder::class);
        $this->call(PagesTagSeeder::class);
        $this->call(PagesToTagSeeder::class);
        $this->call(AdminMenuSeeder::class);
        $this->call(TranslatorLanguageSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(ServicesDataSeeder::class);
    }
}

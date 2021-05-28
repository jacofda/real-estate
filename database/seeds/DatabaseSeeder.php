<?php

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
        $this->call(ExemptionsSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(StarterSeeder::class);
        $this->call(AreasSeeder::class);
        $this->call(ContractsSeeder::class);
        $this->call(FeatsSeeder::class);
        $this->call(FeatsSeeder::class);
        $this->call(TagsSeeder::class);
        $this->call(TypesSeeder::class);
        $this->call(PropertiesSeeder::class);
    }
}

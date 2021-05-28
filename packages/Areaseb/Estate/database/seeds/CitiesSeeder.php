<?php

use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename = 'cities.sql';
        $sql = base_path('database/seeds/'.$filename);
        if(file_exists($sql))
        {
            $dump = file_get_contents($sql);
            \DB::unprepared($dump);
        }
    }
}

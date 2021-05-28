<?php

use Areaseb\Estate\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Type::create([
            'name_it' => 'Residenziale',
            'name_en' => 'Residential',
        ]);

        Type::create([
            'name_it' => 'Commerciale',
            'name_en' => 'Commercial',
        ]);

    }
}

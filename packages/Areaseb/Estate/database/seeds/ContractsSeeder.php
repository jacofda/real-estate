<?php

use Areaseb\Estate\Models\Contract;
use Illuminate\Database\Seeder;

class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contract::create([
            'name_it' => 'Vendita',
            'name_en' => 'Sale',
        ]);

        Contract::create([
            'name_it' => 'Affitto',
            'name_en' => 'Rent',
        ]);

        Contract::create([
            'name_it' => 'Vendita & Affitto',
            'name_en' => 'Sale & Rent',
        ]);

    }
}

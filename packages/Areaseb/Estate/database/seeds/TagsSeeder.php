<?php

use Areaseb\Estate\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create([
            'name_it' => 'Appartamento',
            'name_en' => 'Appartement',
        ]);

        Tag::create([
            'name_it' => 'Hotel/Garni',
            'name_en' => 'Hotel/Garni',
        ]);

        Tag::create([
            'name_it' => 'Appartamento Duplex',
            'name_en' => 'Duplex Appartement',
        ]);

        Tag::create([
            'name_it' => 'Appartamento Duplex Mansardato',
            'name_en' => 'Attic Duplex Appartement',
        ]);

        Tag::create([
            'name_it' => 'Mansarda',
            'name_en' => 'Attic',
        ]);

        Tag::create([
            'name_it' => 'Attico',
            'name_en' => 'Loft',
        ]);

        Tag::create([
            'name_it' => 'Rustico',
            'name_en' => 'Country house',
        ]);

        Tag::create([
            'name_it' => 'Maso',
            'name_en' => 'Hut',
        ]);

        Tag::create([
            'name_it' => 'Altro',
            'name_en' => 'Other',
        ]);

        Tag::create([
            'name_it' => 'Laboratiorio',
            'name_en' => 'Laboratory',
        ]);

        Tag::create([
            'name_it' => 'Villa Singola',
            'name_en' => 'Villa',
        ]);

        Tag::create([
            'name_it' => 'Casa Singola',
            'name_en' => 'Detached House',
        ]);

        Tag::create([
            'name_it' => 'Porzione Terra - Cielo',
            'name_en' => 'House',
        ]);


        Tag::create([
            'name_it' => 'Ristorante',
            'name_en' => 'Restaurant',
        ]);






    }
}

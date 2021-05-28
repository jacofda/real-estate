<?php

use Areaseb\Estate\Models\Feat;
use Illuminate\Database\Seeder;

class FeatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Feat::create([
            'name_it' => 'Ascensore',
            'name_en' => 'Lift',
        ]);

        Feat::create([
            'name_it' => 'Balcone',
            'name_en' => 'Balcony',
        ]);

        Feat::create([
            'name_it' => 'Terrazzo',
            'name_en' => 'Terace',
        ]);

        Feat::create([
            'name_it' => 'Terrazzo abitabile',
            'name_en' => 'Livable Terace',
        ]);


        Feat::create([
            'name_it' => 'Caminetto',
            'name_en' => 'Fireplace',
        ]);

        Feat::create([
            'name_it' => 'Frigorifero',
            'name_en' => 'Fridge',
        ]);

        Feat::create([
            'name_it' => 'Lavatrice',
            'name_en' => 'Washing-machine',
        ]);

        Feat::create([
            'name_it' => 'Lavastoviglie',
            'name_en' => 'Dish-washer',
        ]);

        Feat::create([
            'name_it' => 'Cantina',
            'name_en' => 'Cellar',
        ]);

        Feat::create([
            'name_it' => 'Giardino',
            'name_en' => 'Garden',
        ]);

        Feat::create([
            'name_it' => 'Ripostiglio',
            'name_en' => 'Closet',
        ]);

        Feat::create([
            'name_it' => 'Mansarda',
            'name_en' => 'Attic',
        ]);

        Feat::create([
            'name_it' => 'Studio',
            'name_en' => 'Studio',
        ]);

        Feat::create([
            'name_it' => 'Portineria',
            'name_en' => 'Concierge',
        ]);

        Feat::create([
            'name_it' => 'Taverna',
            'name_en' => 'Tavern',
        ]);

        Feat::create([
            'name_it' => 'Lavanderia',
            'name_en' => 'Washing room',
        ]);

        Feat::create([
            'name_it' => 'Soffitta',
            'name_en' => 'Garret',
        ]);

        Feat::create([
            'name_it' => 'Piscina',
            'name_en' => 'Swimming pool',
        ]);

        Feat::create([
            'name_it' => 'Aria Condizionata',
            'name_en' => 'Air Conditioning',
        ]);

        Feat::create([
            'name_it' => 'Laboratorio',
            'name_en' => 'Laboratory',
        ]);

        Feat::create([
            'name_it' => 'Stube',
            'name_en' => 'Tiled stove',
        ]);

    }
}

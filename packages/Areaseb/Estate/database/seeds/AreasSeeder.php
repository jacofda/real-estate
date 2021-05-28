<?php

use Areaseb\Estate\Models\Area;
use Illuminate\Database\Seeder;

class AreasSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $property_areas = array(
          array('id' => '1','name' => 'Centro','city_id' => '3202'),
          array('id' => '2','name' => 'San Vito di Cadore','city_id' => '3231'),
          array('id' => '3','name' => 'Cortina d\'Ampezzo','city_id' => '3202'),
          array('id' => '4','name' => 'Chiapuzza','city_id' => '3231'),
          array('id' => '5','name' => 'Resinego','city_id' => '3231'),
          array('id' => '6','name' => 'Peaio','city_id' => '3245'),
          array('id' => '7','name' => 'Cancia','city_id' => '3194'),
          array('id' => '8','name' => 'Via Nazionale','city_id' => '3231'),
          array('id' => '9','name' => 'Belvedere','city_id' => '3231'),
          array('id' => '10','name' => 'Centro','city_id' => '3231'),
          array('id' => '11','name' => 'Verocai','city_id' => '3202'),
          array('id' => '12','name' => 'Peziè','city_id' => '3202'),
          array('id' => '14','name' => 'Villanova','city_id' => '3194'),
          array('id' => '15','name' => 'Cibiana di Cadore','city_id' => '3199'),
          array('id' => '16','name' => 'Via Ladinia','city_id' => '3231'),
          array('id' => '17','name' => 'Asolo','city_id' => '3254'),
          array('id' => '18','name' => 'Lozzo di Cadore','city_id' => '3216'),
          array('id' => '19','name' => 'Valle di Cadore','city_id' => '3243'),
          array('id' => '20','name' => 'Serdes','city_id' => '3231'),
          array('id' => '21','name' => 'Via Beata Vergine della Difesa','city_id' => '3231'),
          array('id' => '22','name' => 'Vodo Cadore','city_id' => '3245'),
          array('id' => '23','name' => 'Porto Rotondo','city_id' => '7029'),
          array('id' => '24','name' => 'Corte','city_id' => '3194'),
          array('id' => '25','name' => 'Venas','city_id' => '3243'),
          array('id' => '26','name' => 'Borca di Cadore','city_id' => '3194')
        );

        foreach($property_areas  as $area)
        {
            Area::create([
                'name' => $area['name'],
                'city_id' => $area['city_id']
            ]);
        }

    }


}

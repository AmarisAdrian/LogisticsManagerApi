<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PuertoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('puertos')->Delete();
     
        DB::table('puertos')->insert([
            ['nombre' => 'Puerto de barranquilla',"id_ubicacion" => 1,"capacidad_recepcion" => 100],
            ['nombre' => 'Puerto de cartagena',"id_ubicacion" =>1,"capacidad_recepcion" => 100],
        ]);
    }
}

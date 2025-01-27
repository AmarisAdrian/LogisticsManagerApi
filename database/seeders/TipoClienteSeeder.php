<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_cliente')->Delete();
     
        DB::table('tipo_cliente')->insert([
            ['nombre' => 'Nacional'],
            ['nombre' => 'Internacional'],
        ]);
    }
}

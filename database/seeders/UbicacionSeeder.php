<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UbicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ubicacion')->Delete();
     
        DB::table('ubicacion')->insert([
            ['nombre' => 'Nacional'],
            ['nombre' => 'Internacional']
        ]);
    }
}

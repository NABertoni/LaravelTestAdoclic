<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insertar registros en la tabla categories
        DB::table('categories')->insert([
            ['category' => 'Animals'],
            ['category' => 'Security'],
        ]);
    }
}

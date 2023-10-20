<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->delete();
        $categoreis = [
            'category_type_id' => 1,
            'name' => 'Default',
            'slug' => 'default',
        ];
        DB::table('categories')->insert($categoreis);
    }
}

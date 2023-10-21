<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MediaCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('media_categories')->delete();
        $media_categories = [
            'name' => 'Uncategorize',
        ];
        DB::table('media_categories')->insert($media_categories);
    }
}

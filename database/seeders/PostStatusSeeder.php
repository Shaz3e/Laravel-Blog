<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('post_statuses')->delete();
        $post_statuses = [
            [
                'name' => 'Draft',
            ],
            [
                'name' => 'Published',
            ],
            [
                'name' => 'Private',
            ],
        ];
        DB::table('post_statuses')->insert($post_statuses);
    }
}

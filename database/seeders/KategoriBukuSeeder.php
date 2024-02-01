<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriBukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['kategori' => 'Fiction' ],
            ['kategori' => 'Science'],
            ['kategori' => 'History'],
        ];

        foreach ($categories as $category){
            DB::table('kategori_buku')->insert([
                'kategori' => $category['kategori'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

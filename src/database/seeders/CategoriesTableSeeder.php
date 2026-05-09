<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'category' => 'category1'
        ];
        DB::table('categories')->insert($param);

        $param = [
            'categories' => 'category2'
        ];
        DB::table('categories')->insert($param);
    }
}

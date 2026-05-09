<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TodosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'content' => 'test',
            'category_id' => 'category1',
        ];
        DB::table('todos')->insert($param);

        $param = [
            'content' => 'test2',
            'category_id' => 'category2',
        ];
        DB::table('todos')->insert($param);
    }
}

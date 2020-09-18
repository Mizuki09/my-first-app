<?php

use Illuminate\Database\Seeder;

class SchoolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('schools')->insert([
//            ['name' =>"dummy"],
//        ]);
//        DB::table('schools')->insert([
//            ['name' =>"未設定"],
//        ]);
        for ($i='A';$i < 'Z';$i++) {
            DB::table('schools')->insert([
                ['name' =>"${i}学校"],
            ]);
        }
    }
}

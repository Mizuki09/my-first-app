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
        for ($i='A';$i < 'Z';$i++) {
            DB::table('schools')->insert([
                ['name' =>"${i}学校"],
            ]);
        }
    }
}

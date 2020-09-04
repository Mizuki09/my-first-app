<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'ゲスト',
                'password' => 'xxxxx',
                'email' => 'xxxxxx@xxx.com',
            ],

            [
                'name' => 'ゲスト2',
                'password' => 'xxxxxxx',
                'email' => 'xxxxxxx@xxx.com',
            ],
            [
                'name' => 'ゲスト3',
                'password' => 'vvvvv',
                'email' => 'vvvvvvv@xxx.com',
            ],

            [
                'name' => 'ゲスト4',
                'password' => 'bbbbbb',
                'email' => 'bbbbbbb@xxx.com',
            ],
            [
                'name' => 'ゲスト5',
                'password' => 'ssssss',
                'email' => 'sssssss@xxx.com',
            ],

            [
                'name' => 'ゲスト6',
                'password' => 'dddddd',
                'email' => 'ddddddd@xxx.com',
            ]
        ]);
    }
}

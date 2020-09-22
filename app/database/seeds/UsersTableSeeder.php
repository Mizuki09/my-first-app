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
        for ($i=1;$i <= 1000;$i++) {
            DB::table('users')->insert([
                [
                    'name' => "${i}さん",
                    'password' => "${i}guestguest",
                    'email' => "${i}guest@guest.com",
                    'school'=>rand(1,24),
                    'created_at' => "2020" . '/' . "08" . '/' .  sprintf("%02d", strval(rand(20 , 30))) . ' ' . strval(rand(1 , 23)) . ':' . sprintf("%02d", strval(rand(1 , 59))) . ':' . sprintf("%02d", strval(rand(1 , 59))),

                ],
            ]);
        }
    }
}

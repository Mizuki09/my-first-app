<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $videos = [
            ['https://www.youtube.com/watch?v=rQPEmsJ_n0A' , 'animal'],
            ['https://www.youtube.com/watch?v=gmivvunbAaQ' , 'animal'],
            ['https://www.youtube.com/watch?v=CZzDjmVobnM' , 'animal'],
            ['https://www.youtube.com/watch?v=I8W6A9yaUX8' , 'animal'],
            ['https://www.youtube.com/watch?v=qPZ1VCrhAIo' , 'animal'],
            ['https://www.youtube.com/watch?v=YJVmu6yttiw' , 'music'],
            ['https://www.youtube.com/watch?v=9MjAJSoaoSo' , 'music'],
            ['https://www.youtube.com/watch?v=EBwx7GBy2oM' , 'music'],
            ['https://www.youtube.com/watch?v=0iAF8TJAqp4' , 'music'],
            ['https://www.youtube.com/watch?v=MpYy6wwqxoo' , 'music'],
            ['https://www.youtube.com/watch?v=5PxDE46bFL8' , 'sports'],
            ['https://www.youtube.com/watch?v=TAZ_B_GXfwA' , 'sports'],
            ['https://www.youtube.com/watch?v=7BbLUhZYBvo' , 'sports'],
            ['https://www.youtube.com/watch?v=TDKFXLRnPjM' , 'sports'],
            ['https://www.youtube.com/watch?v=xaTf54MOfXM' , 'sports'],
            ['https://www.youtube.com/watch?v=-N46XG_o9x8' , 'travel'],
            ['https://www.youtube.com/watch?v=ue3U-vF3lQE' , 'travel'],
            ['https://www.youtube.com/watch?v=P_f9tuABVxU' , 'travel'],
            ['https://www.youtube.com/watch?v=rNYyVCQI_ik' , 'travel'],
            ['https://www.youtube.com/watch?v=PlSrjSLEQqc' , 'travel'],
            ['https://www.youtube.com/watch?v=8kry8wAroTk' , 'cooking'],
            ['https://www.youtube.com/watch?v=ikeiF27Ng4Y' , 'cooking'],
            ['https://www.youtube.com/watch?v=tGjCHWVVEKo' , 'cooking'],
            ['https://www.youtube.com/watch?v=lHauJOJoam4' , 'cooking'],
            ['https://www.youtube.com/watch?v=GFPNgs9-Uf8' , 'cooking'],
            ['https://www.youtube.com/watch?v=9wU8D199RUE' , 'game'],
            ['https://www.youtube.com/watch?v=wSK5yLvqUQA' , 'game'],
            ['https://www.youtube.com/watch?v=ZvkTJudx5-g' , 'game'],
            ['https://www.youtube.com/watch?v=0IuM6yBr72U' , 'game'],
        ];
        foreach ($videos as $video) {
            DB::table('videos')->insert([
                [
                    'user_id' => rand(1 , 6),
                    'url' => $video[0],
                    'category' => "$video[1]",
                    'created_at' => "2020" . '/' . "08" . '/' .  sprintf("%02d", strval(rand(20 , 30))) . ' ' . strval(rand(1 , 23)) . ':' . sprintf("%02d", strval(rand(1 , 59))) . ':' . sprintf("%02d", strval(rand(1 , 59))),
                ],
            ]);
        }
    }
}

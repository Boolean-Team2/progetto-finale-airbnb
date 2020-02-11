<?php

use Illuminate\Database\Seeder;

use App\Ad;

class AdSeeder extends Seeder
{
    public function run()
    {
        $ads = [
            [
                'name' => '24h', 
                'start_time' => new DateTime(),
                'end_time' => date("Y-m-d H:i:s", time() + 86400)
            ],
            [
                'name' => '72h', 
                'start_time' => new DateTime(),
                'end_time' => date("Y-m-d H:i:s", time() + 259200)
            ],
            [
                'name' => '144h', 
                'start_time' => new DateTime(),
                'end_time' => date("Y-m-d H:i:s", time() + 518400)
            ],
        ];

        foreach ($ads as $ad) {
            $newAd = new Ad;
            $newAd -> fill($ad) -> save();
        }
    }
}

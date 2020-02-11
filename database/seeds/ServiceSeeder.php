<?php

use Illuminate\Database\Seeder;

use App\Service;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $services = [
            ['name' => 'wifi'],
            ['name' => 'parking'],
            ['name' => 'pool'],
            ['name' => 'reception'],
            ['name' => 'sauna'],
            ['name' => 'sea view']
        ];

        foreach ($services as $service) {
            $newService = new Service;
            $newService -> fill($service) -> save();
        }
    }
}

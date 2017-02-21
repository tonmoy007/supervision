<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class GallarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1,10) as $index){
            \App\Models\Gallary::create([
                'type' => "image",
                'file' => $faker->imageUrl(),
            ]);
            \App\Models\Slider::create([
                'image' => $faker->imageUrl(),
                'description' => "LOL",
            ]);
        }
    }
}

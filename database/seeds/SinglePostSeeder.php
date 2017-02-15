<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Models\SinglePost;

class SinglePostSeeder extends Seeder
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
            SinglePost::create([
                'title' =>$faker->title,
                'type' => $faker->creditCardType,
                'subtitle' => $faker->title,
                'content' => $faker->text,
                'featured_image'=>$faker->imageUrl(),
            ]);
        }

    }
}

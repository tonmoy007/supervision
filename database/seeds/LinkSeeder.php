<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Models\Link;

class LinkSeeder extends Seeder
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
            Link::create([
                'name' =>$faker->name,
                'type' => $faker->creditCardType,
                'url' => $faker->url,
            ]);
        }
    }
}

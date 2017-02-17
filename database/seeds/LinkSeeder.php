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
        $category = ['কেন্দ্রীয় ই-সেবা','ই-সেবা,জেলা প্রসাসন', 'অন্যান্য ই-সেবা'];
        foreach (range(1,10) as $index){
            Link::create([
                'name' =>$faker->name,
                'type' => $category[rand(0,2)],
                'url' => $faker->url,
            ]);
        }
        foreach ($category as $category) {
            \App\Models\LinkCategory::create(['category'=>$category]);
        }
    }
}

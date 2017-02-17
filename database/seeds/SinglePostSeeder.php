<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Models\SinglePost;
use App\Models\PostCategory;

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
        $category = ['আমাদের সম্পর্কে' ,'শিক্ষা অফিসের কার্যক্রম','ডিজিটাল সেবা সমূহ','যোগাযোগ','খবর','বানী','সাধারন তথ্য'];
        foreach (range(1,10) as $index){
            SinglePost::create([
                'title' =>$faker->title,
                'type' => $category[rand(0, 6)],
                'subtitle' => $faker->title,
                'content' => $faker->text,
                'featured_image'=>$faker->imageUrl(),
                'user_id' => rand(1,20),
            ]);
        }

         foreach ($category as $category) {
            PostCategory::create(['category'=>$category]);
        }
    }
}

<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**+
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();
        foreach(range(1,20) as $index){

            $school= \App\Models\School::find($index);
            foreach (range(1,3) as $ind) {
                $class = new \App\Models\Classes([
                    'name' => $faker->colorName,
                    'total_students' => $faker->numberBetween(5, 100)

                ]);
                $school->classes()->save($class);
            }

        }
    }
}

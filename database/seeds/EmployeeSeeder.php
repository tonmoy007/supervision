<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
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
            Employee::create([
                'name' =>$faker->name,
                'designation' => $faker->jobTitle,
                'rank' => $faker->randomLetter,
                'image'=>$faker->imageUrl(),
            ]);
        }
    }
}

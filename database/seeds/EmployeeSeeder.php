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
        $category = ['কর্মকর্তা', 'কর্মচারী', 'সাবেক কর্মকর্তা', ];
        foreach (range(1,10) as $index){
            Employee::create([
                'name' =>$faker->name,
                'designation' => $category[rand(0,2)],
                'rank' => $faker->randomLetter,
                'image'=>$faker->imageUrl(),
            ]);
        }
        foreach ($category as $category) {
            \App\Models\EmployeeCategory::create(['category'=>$category]);
        }
    }
}

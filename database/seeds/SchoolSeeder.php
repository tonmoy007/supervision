<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Models\School;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();
        foreach(range(1,20) as $index){
            static $password;

            $user= \App\Models\User::find($index);
            $school = new School([
                'category' => $faker->creditCardType,
                'teacher' => $faker->randomNumber(3),
                'female_teacher' => $faker->randomNumber(3),
                'upozilla' => $faker->streetName,
                'zilla' => $faker->city,
                'management' => $faker->company,
                'type' => $faker->name,
                'mpo_code' => $faker->creditCardNumber,
                'mpo_date' =>$faker->date(),
                'eiin_number' => $faker->bankAccountNumber,


                ]);
            $user->schools()->save($school);
        }
    }
}

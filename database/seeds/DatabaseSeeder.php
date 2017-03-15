<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        $this->call(UserSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(LinkSeeder::class);
        $this->call(SinglePostSeeder::class);
        $this->call(SchoolSeeder::class);
        $this->call(GallarySeeder::class);
        $this->call(ClassSeeder::class);
        $this->call(NoticeSeeder::class);
        $this->call(QuestionSeeder::class);
        $this->call(AnswerSeeder::class);
    }
}

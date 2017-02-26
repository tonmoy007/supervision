<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Models\Notice;
use App\Models\User;
use App\Models\NoticeSeen;
class NoticeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();
        Notice::create([
            'title' => $faker->title,
            'description' => $faker->text,
            'notice_file' => $faker->imageUrl(),
        ]);
        $users = User::all();
        foreach ($users as $user) {
            if($user->roles->first()['name']!='admin'){
                $noticeSeen = new NoticeSeen();
                $noticeSeen->user_id= $user->id;
                $noticeSeen->notice_id= 1;
                $noticeSeen->is_seen = false;
                $noticeSeen->save();
            }
        }

    }
}

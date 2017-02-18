<?php 

use Faker\Factory as Faker;
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder{
    

    public function run(){

        $faker=Faker::create();
        Role::create([
            'name'=>'admin',
            'display_name'=>'Admin',
            'description'=>'All Priviledges'
            ]);
        Role::create([
            'name'=>'general_user',
            'display_name'=>'General User',
            'description'=>'User Priviledges'
            ]);

        

        foreach(range(1,20) as $index){
            static $password;
            
            if($index==1){
                $email='general@general.com';
            }else if($index==2){
                $email='admin@admin.com';
            }else{
                $email=$faker->unique()->safeEmail;
            }

            User::create([
                'name' => $faker->name,
                'email' => $email,
                'password' => $password ?: $password = bcrypt('password'),
                'remember_token' => str_random(10),
                ]);
            $user=User::find($index);
            $role = Role::where('name', '=', 'admin')->first();
            $user->roles()->attach(''.$index%2+1);


        }
        
    }
}

<?php
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder {
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@mail.com',
            'role' => 'admin',
            'password' => bcrypt('123456'),
            'created_at'      => date("Y-m-d H:i:s"),
            'remember_token'  => str_random(10),
        ]);
        // $faker = Faker::create();
        // foreach(range(1, 3) as $index)
        // {
        //     User::create([
        //         'name' => $faker->word . $index,
        //         'email' => $faker->email,
        //         'role' => 'editor',
        //         'password' => bcrypt('secret')
        //     ]);
        // }
    }
}
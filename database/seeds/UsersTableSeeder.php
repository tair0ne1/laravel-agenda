<?php

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        //Making 10 users
        for ($i=0; $i < 10; $i++) {
            User::create([
                'name' => $faker->name(),
            ]);
        }
    }
}

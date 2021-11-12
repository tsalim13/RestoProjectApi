<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'User1',
            'email' => 'user1@email.com',
            'phone' => '066666666',
            'password' => bcrypt('password'),
        ]);
        $api_token = $user->createToken('PassportToken@App.com')->accessToken;

        $user = User::create([
            'name' => 'User3',
            'email' => 'user3@email.com',
            'phone' => '066666666',
            'password' => bcrypt('password'),
        ]);

        $api_token = $user->createToken('PassportToken@App.com')->accessToken;

        $user = User::create([
            'name' => 'User2',
            'email' => 'user2@email.com'2,
            'phone' => '066666666',
            'password' => bcrypt('password'),
        ]);

        $api_token = $user->createToken('PassportToken@App.com')->accessToken;

        DB::table('users')->insert([
            'name' => 'user2',
            'email' => 'user2@email.com',
            'password' => bcrypt('password'),
        ]);
        $user = User::create([
            'name' => 'user2',
            'email' => 'user2@email.com',
            'password' => bcrypt('password'),
        ]);

        $api_token = $user->createToken('PassportToken@App.com')->accessToken;

    }
}

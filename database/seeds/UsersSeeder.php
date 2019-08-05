<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(\App\Models\User::class,20)->create();
        $user = $users->find(1);
        $user -> update([
            'name' => 'junge',
            'email' => 'juncr.feng@gmail.com',
            'password' => bcrypt('huan0579'),
            'remember_token' => Str::random(10),
        ]);
    }
}

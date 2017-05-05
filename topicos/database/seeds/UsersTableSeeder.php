<?php

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
        factory(\App\User::class,1)
            ->create([
                'name' => 'Eduardo Colombo',
                'email' => 'eduardo@user.com'
            ]);

        factory(\App\User::class,1)
            ->create([
                'name' => 'Administrator',
                'email' => 'admin@user.com'
            ]);
    }
}

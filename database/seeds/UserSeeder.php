<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'  => 'Luffy',
            'email' => 'luffy@gmail.com',
            'password'  => bcrypt('12345')
        ]);

        User::create([
            'name'  => 'Naruto',
            'email' => 'naruto@gmail.com',
            'password'  => bcrypt('12345')
        ]);

        User::create([
            'name'  => 'Goku',
            'email' => 'goku@gmail.com',
            'password'  => bcrypt('12345')
        ]);

        User::create([
            'name'  => 'Saitama',
            'email' => 'saitama@gmail.com',
            'password'  => bcrypt('12345')
        ]);
    }
}

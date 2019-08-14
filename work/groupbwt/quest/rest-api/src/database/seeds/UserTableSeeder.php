<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pass = bcrypt('12345678');
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => $pass
        ])->assignRole('admin');
        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => $pass
        ])->assignRole('user');
    }
}

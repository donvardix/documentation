<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $admin = [
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$NvFDEq.uz9AuCxlds5rN5.CbCk3HtQyEoPwv5AVa5Ad6qZCMQoXk6'
        ];
        DB::table('users')->insert($admin);
    }
}

<?php

use Illuminate\Database\Seeder;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('members')->delete();
        $members = [];
        for ($i = 1; $i <= 200; $i++) {
            $members[] = [
                'firstname' => 'Name' . $i,
                'lastname' => 'Lastname' . $i,
                'birthdate' => '1992-05-15',
                'reportsubject' => 'Work',
                'country' => 'Angola',
                'phone' => '+12345678945',
                'email' => 'name' . $i . '@gmail.com',
                'company' => 'Nuke',
                'position' => 'Manager',
                'aboutme' => 'Text'
            ];
        }

        DB::table('members')->insert($members);
    }
}

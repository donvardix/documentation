<?php

use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Database\Seeder;

class HotelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Hotel::class, 1000)->create()->each(function ($hotel) {
            $hotel->rooms()->save(factory(Room::class, 'rooms')->make());
        });
    }
}

<?php

namespace App\Policies;

use App\Models\Parser;
use App\Models\Room;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoomPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function checkUserRoom(User $user, Room $room)
    {
        if (!$user->hasRole('admin')) {
            $parser = Parser::where('hotel_id', $room->hotel_id)->first();
            if (is_null($parser) ? true : $parser->user_id != $user->id) {
                return false;
            }
        }
        return true;
    }
}

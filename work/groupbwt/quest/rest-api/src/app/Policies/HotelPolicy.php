<?php

namespace App\Policies;

use App\Models\Hotel;
use App\Models\Parser;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HotelPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function checkUserHotel(User $user, Hotel $hotel)
    {
        if (!$user->hasRole('admin')) {
            $parser = Parser::where('hotel_id', $hotel->id)->first();
            if (is_null($parser) ? true : $parser->user_id != $user->id) {
                return false;
            }
        }
        return true;
    }

}

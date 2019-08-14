<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\HotelRoomsCheckUserRequest;
use App\Http\Requests\HotelCheckUserRequest;
use App\Models\Hotel;
use App\Http\Controllers\Controller;
use App\Models\Room;

class HotelRoomController extends Controller
{
    public function index(HotelCheckUserRequest $request, Hotel $hotel)
    {
        $rooms = Room::where('hotel_id', $hotel->id)->paginate(20);
        return response()->api($rooms->load('roomVariants'));
    }

    public function show(HotelRoomsCheckUserRequest $request, Hotel $hotel, Room $room)
    {
        return response()->api($room->load('roomVariants'));
    }
}

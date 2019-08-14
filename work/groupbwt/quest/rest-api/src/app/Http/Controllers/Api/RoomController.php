<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\RoomCheckUserRequest;
use App\Models\Parser;
use App\Models\Room;
use App\Http\Controllers\Controller;

class RoomController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $rooms = Room::with('roomVariants')
            ->when(!$user->hasRole('admin'), function ($query) use ($user) {
                $ids = Parser::where('user_id', $user->id)->pluck('hotel_id');
                $query->whereIn('hotel_id', $ids);
            })
            ->paginate(20);
        return response()->api($rooms);
    }

    public function show(RoomCheckUserRequest $request, Room $room)
    {
        return response()->api($room->load('roomVariants'));
    }
}

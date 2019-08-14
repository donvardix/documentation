<?php

namespace App\Http\Controllers\Api;

use App\Models\Hotel;
use App\Models\Parser;
use App\Http\Requests\HotelAddRequest;
use App\Http\Requests\HotelUpdateRequest;
use App\Http\Requests\HotelCheckUserRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class HotelController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $hotels = Hotel::with('rooms')
            ->when(!$user->hasRole('admin'), function ($query) use ($user) {
                $query->whereHas('parsers', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                });
            })
            ->paginate(20);
        return response()->api($hotels);
    }

    public function show(HotelCheckUserRequest $request, Hotel $hotel)
    {
        return response()->api($hotel->load('rooms'));
    }

    public function store(HotelAddRequest $request)
    {
        $hotel = Hotel::create($request->all());
        Parser::create([
            'hotel_id' => $hotel->id,
            'user_id' => auth()->user()->id
        ]);
        return response()->api($hotel, Response::HTTP_CREATED);
    }

    public function update(HotelUpdateRequest $request, Hotel $hotel)
    {
        $hotel->update($request->all());
        return response()->api($hotel);
    }

    public function destroy(HotelCheckUserRequest $request, Hotel $hotel)
    {
        $hotel->delete();
        return response()->api();
    }
}

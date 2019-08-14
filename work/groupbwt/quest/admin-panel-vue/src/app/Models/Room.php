<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['name', 'image', 'price', 'occupancy', 'hotel_id'];

    public $timestamps = false;

    public function roomVariants()
    {
        return $this->hasMany(RoomVariant::class);
    }
}

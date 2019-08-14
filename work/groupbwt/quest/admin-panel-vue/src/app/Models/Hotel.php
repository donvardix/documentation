<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = [
        'name',
        'description',
        'address',
        'city',
        'postcode',
        'country',
        'rating',
        'image',
        'url_hotel'
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function parsers()
    {
        return $this->hasOne(Parser::class);
    }
}

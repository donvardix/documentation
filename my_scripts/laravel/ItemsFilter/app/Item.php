<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}

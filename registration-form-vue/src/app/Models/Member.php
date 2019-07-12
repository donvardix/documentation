<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Member extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'firstname',
        'lastname',
        'birthdate',
        'reportsubject',
        'country',
        'phone',
        'email',
        'company',
        'position',
        'aboutme',
        'photo'
    ];
    protected $dates = ['deleted_at'];

}

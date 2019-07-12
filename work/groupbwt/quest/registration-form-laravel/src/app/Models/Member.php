<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public static function createForm2($data)
    {
        $member = Member::find(session()->get('memberId'));
        $member->company = $data->company;
        $member->position = $data->position;
        $member->aboutme = $data->aboutme;
        $member->photo = self::uploadImage($data->file('photo'));
        $member->save();
    }

    public static function uploadImage($photo)
    {
        if (!empty($photo)) {
            return $photo->store('uploads', 'public');
        } else {
            return null;
        }
    }

}

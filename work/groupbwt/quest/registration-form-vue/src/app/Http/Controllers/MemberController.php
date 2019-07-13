<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Country;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MemberController extends Controller
{

    public function index()
    {
        return view('index');
    }

    public function countMembers()
    {
        return response()->json([
            'count' => Member::count(),
        ], 200);
    }

    public function countries()
    {
        return response()->json([
            'countries' => Country::all()->pluck('country')
        ], 200);
    }

    public function store(Request $data)
    {
        $validator = Validator::make($data->all(), [
            'email' => 'required|email|max:50|unique:members'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'email' => 'error'
            ]);
        }

        $member = Member::create($data->only([
            'firstname',
            'lastname',
            'birthdate',
            'reportsubject',
            'country',
            'phone',
            'email'
        ]));
        session(['memberId' => $member->id]);
        return response()->json([
            'count' => Member::count(),
        ]);
    }

    public function store2(Request $data)
    {
        $member = Member::find(session()->get('memberId'));
        $member->company = $data->company;
        $member->position = $data->position;
        $member->aboutme = $data->aboutme;
        $member->photo = self::uploadImage($data->file('photo'));
        $member->save();
        session()->flush();
        return response()->json([
            'status' => 'OK',
        ]);
    }

    public static function uploadImage($photo)
    {
        if (!empty($photo)) {
            $ext = $photo->getClientOriginalExtension();
            $hashed = uniqid();
            $photo->storeAs('uploads', $hashed . '.' . $ext, 'public');
            return $hashed . '.' . $ext;
        } else {
            return null;
        }

    }

    public function session()
    {
        if (session()->exists('memberId')) {
            return response()->json([
                'session' => 1
            ]);
        } else {
            return response()->json([
                'session' => 0
            ]);
        }
    }

    public function members()
    {
        return response()->json([
            'membersAdmin' => Member::withTrashed()->orderBy('id', 'desc')->get(),
            'members' => Member::orderBy('id', 'desc')->get(),
            'defaultAvatar' => config('app.default_avatar')
        ]);
    }

    public function show($id)
    {
        Member::onlyTrashed()->find($id)->restore();
    }

    public function hide($id)
    {
        Member::find($id)->delete();
    }

    public function login(Request $data)
    {
        if (Auth::attempt(['email' => $data->email, 'password' => $data->password])) {
            $token = Str::random(60);
            $member = User::find(1);
            $member->remember_token = $token;
            $member->save();
            return response()->json([
                'status' => 'OK',
                'token' => $token
            ]);
        } else {
            return response()->json([
                'status' => 'NO'
            ]);
        }
    }

    public function checkAdmin(){
        $admin = User::find(1);
        return response()->json([
            'status' => $admin->remember_token
        ]);
    }

}

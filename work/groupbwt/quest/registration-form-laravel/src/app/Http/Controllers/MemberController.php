<?php

namespace App\Http\Controllers;

use App\Http\Requests\Form1Request;
use App\Http\Requests\Form2Request;
use App\Models\Member;
use App\Models\Country;

class MemberController extends Controller
{

    public function index()
    {
        $data = [
            'number' => Member::count(),
            'countries' => Country::all(),
            'text' => config('twitter.text'),
            'url' => config('twitter.url')
        ];
        if (session()->has('memberId')) {
            return view('index', $data, [
                'showForm1' => 'display: none',
                'showForm2' => ''
            ]);
        } else {
            return view('index', $data, [
                'showForm1' => '',
                'showForm2' => 'display: none'
            ]);
        }
    }

    public function store(Form1Request $data)
    {
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
            'number' => Member::count(),
        ]);
    }

    public function store2(Form2Request $data)
    {
        Member::createForm2($data);
        session()->flush();
        return response()->json([
            'status' => 'OK',
        ]);
    }

    public function members()
    {
        return view('members', [
            'members' => Member::orderBy('id', 'desc')->paginate(20),
            'membersForAdmin' => Member::withTrashed()->orderBy('id', 'desc')->paginate(20),
            'defaultAvatar' => config('app.default_avatar')
        ]);
    }

    public function show($id)
    {
        Member::onlyTrashed()->find($id)->restore();
        return redirect()->route('all_members');
    }

    public function hide($id)
    {
        Member::find($id)->delete();
        return redirect()->route('all_members');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\User;
use App\Http\Resources\MemberResource;

class MemberController extends Controller
{
    public function index()
    {
        return view('members.index');
    }

    public function show()
    {
        return view('members.create');
    }

    // public function store(MemberFormRequest $request)
    // {
    //     $member['is_private'] = $request->get('private') ? 1 : 0;
    //
    //     $user = User::create([
    //         'name' => $member['name'],
    //         'email' => $member['email'],
    //         'password' => Hash::make($member['password'])
    //
    //     ]);
    //
    //     if ($user) {
    //         Member::create([
    //             'user_id' => $user->id,
    //             'alias' => $member['name'],
    //             'is_private' => $member['is_private']
    //         ]);
    //     }
    //
    //     return new MemberResource($user);
    // }
}

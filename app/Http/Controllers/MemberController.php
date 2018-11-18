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

    public function create()
    {
        return view('members.create');
    }
}

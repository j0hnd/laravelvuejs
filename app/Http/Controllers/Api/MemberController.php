<?php

namespace App\Http\Controllers\Api;

use App\Member;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MemberResource;
use App\Http\Requests\MemberFormRequest;
use Hash;

class MemberController extends Controller
{
    public function index()
    {
        $users = User::latest()->notDeleted()->get();

        return MemberResource::collection($users);
    }

    public function edit(User $user)
    {
        // return MemberResource::collection($user);
        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'private' => $user->member->is_private ? 1 : null,
            'date' => $user->created_at->format('Y-m-d H:i:s')
        ]);
    }

    public function store(MemberFormRequest $request)
    {
        $user = new User($request->only(['name', 'email']));
        $user->password = Hash::make($request->password);
        $user->save();

        $member = new Member([
            'alias' => $request->get('name'),
            'is_private' => $request->has('private')
        ]);
        $user->member()->save($member);

        return new MemberResource($user);
    }

    public function update(MemberFormRequest $request, User $user)
    {
        $user->fill($request->only(['name', 'email']));
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($user->save()) {
            $member = Member::find($user->member->id);
            $member->alias = $user->name;
            $member->is_private = $request->private;

            $member->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    public function delete(User $user)
    {
        if ($user->delete()) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}

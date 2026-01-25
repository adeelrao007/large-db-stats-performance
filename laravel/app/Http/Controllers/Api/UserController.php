<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()
            ->with(['account'])
            ->paginate(20);

        return UserResource::collection($users);
    }

    public function show(User $user)
    {
        $user->load(['account', 'addresses']);

        return new UserResource($user);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'account_id' => 'required|exists:accounts,id',
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
        ]);

        $user = User::create($data);

        return new UserResource($user);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'string',
            'email' => 'email|unique:users,email,'.$user->id,
        ]);

        $user->update($data);

        return new UserResource($user);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['message' => 'User deleted']);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    /**
     * List users
     *
     * @group Users
     * @authenticated
     *
     * Get a paginated list of users.
     *
     * @responseField data[].id integer The ID of the user
     * @responseField data[].name string The name of the user
     * @responseField data[].email string The email of the user
     */
    public function index(Request $request)
    {
        $users = User::query()
            ->with(['account'])
            ->paginate(20);

        return UserResource::collection($users);
    }


    /**
     * Show user details
     *
     * @group Users
     * @authenticated
     *
     * Get details for a specific user.
     *
     * @urlParam user integer required The ID of the user.
     * @responseField id integer The ID of the user
     * @responseField name string The name of the user
     * @responseField email string The email of the user
     */
    public function show(User $user)
    {
        $user->load(['account', 'addresses']);

        return new UserResource($user);
    }


    /**
     * Create a new user
     *
     * @group Users
     * @authenticated
     *
     * @bodyParam account_id integer required The account ID. Example: 1
     * @bodyParam name string required The user's name. Example: John Doe
     * @bodyParam email string required The user's email. Example: john@example.com
     *
     * @responseField id integer The ID of the user
     * @responseField name string The name of the user
     * @responseField email string The email of the user
     */
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


    /**
     * Update a user
     *
     * @group Users
     * @authenticated
     *
     * @urlParam user integer required The ID of the user.
     * @bodyParam name string The user's name. Example: Jane Doe
     * @bodyParam email string The user's email. Example: jane@example.com
     *
     * @responseField id integer The ID of the user
     * @responseField name string The name of the user
     * @responseField email string The email of the user
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'string',
            'email' => 'email|unique:users,email,' . $user->id,
        ]);

        $user->update($data);

        return new UserResource($user);
    }

    /**
     * Delete a user
     *
     * @group Users
     * @authenticated
     *
     * @urlParam user integer required The ID of the user.
     *
     * @response 200 {"message": "User deleted"}
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['message' => 'User deleted']);
    }
}

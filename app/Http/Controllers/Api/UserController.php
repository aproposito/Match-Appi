<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::all());
    }

    public function show(Request $request, User $user)
    {
        if (!$this->authorizeUserAccess($request, $user)) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        return response()->json(new UserResource($user));
    }
    public function update(UpdateUserRequest $request, User $user)
    {
        if (!$this->authorizeUserAccess($request, $user)) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $user->update($request->validated());
        return response()->json(new UserResource($user));
    }

    public function destroy(Request $request, User $user)
    {
        if (!$this->authorizeUserAccess($request, $user)) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $user->delete();
        return response()->json(new UserResource($user));
    }

    private function authorizeUserAccess(Request $request, User $user): bool
    {
        return $request->user()->role === 'admin' || $request->user()->id === $user->id;
    }
}

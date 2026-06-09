<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function show(Request $request, User $user)
    {
        if (!$this->authorizeUserAccess($request, $user)) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        return response()->json($user);
    }
    public function update(Request $request, User $user)
    {
     
        if (!$this->authorizeUserAccess($request, $user)) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $request->validate([
            'name' => 'sometimes|string',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|min:8|confirmed',
        ]);

        $user->update($request->only(['name', 'email', 'password']));

        return response()->json($user);
    }

    public function destroy(Request $request, User $user)
    {
      
        if (!$this->authorizeUserAccess($request, $user)) {
            return response()->json(['message' => 'No autorizado'], 403);
        }
        $user->delete();

        return response()->json($user);
    }

    private function authorizeUserAccess(Request $request, User $user): bool
    {
        return $request->user()->role === 'admin' || $request->user()->id === $user->id;
    }
}

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

    public function show(Request $request, $id)
{
    $user = User::findOrFail($id);
    
    if ($request->user()->role !== 'admin' && $request->user()->id !== $user->id) {
        return response()->json(['message' => 'No autorizado'], 403);
    }
    
    return response()->json($user);
}

}

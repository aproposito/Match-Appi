<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OA;

class AuthController extends Controller
{
        #[OA\Post(
        path: '/api/login',
        summary: 'Login de usuario',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'email', type: 'string', example: 'user@matchappi.com'),
                    new OA\Property(property: 'password', type: 'string', example: 'password'),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Token de acceso'),
            new OA\Response(response: 401, description: 'Credenciales incorrectas'),
        ]
    )]
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken('auth_token')->accessToken;

        return response()->json(['token' => $token], 201);
    }
    #[OA\Post(
    path: '/api/logout',
    summary: 'Cierre de sesión',
    security: [['bearerAuth' => []]],
    responses: [
        new OA\Response(response: 200, description: 'Sesión cerrada'),
        new OA\Response(response: 401, description: 'No autenticado'),
    ]
)]
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Credenciales incorrectas'], 401);
        }

        $token = Auth::user()->createToken('auth_token')->accessToken;
        return response()->json(['token' => $token], 200);
    }
    public function logout(Request $request)
{
    $request->user()->token()->revoke();
    
    return response()->json(['message' => 'Sesión cerrada correctamente'], 200);
}
}

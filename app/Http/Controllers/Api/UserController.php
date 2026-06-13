<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use OpenApi\Attributes as OA;

class UserController extends Controller
{
    #[OA\Get(
        path: '/api/users',
        summary: 'Lista todos los usuarios (solo admin)',
        security: [['bearerAuth' => []]],
        responses: [
            new OA\Response(response: 200, description: 'Lista de usuarios'),
            new OA\Response(response: 401, description: 'No autenticado'),
            new OA\Response(response: 403, description: 'No autorizado'),
        ]
    )]
    public function index()
    {
        return UserResource::collection(User::all());
    }
     #[OA\Get(
        path: '/api/users/{id}',
        summary: 'Ver perfil de usuario',
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
        ],
        responses: [
            new OA\Response(response: 200, description: 'Perfil de usuario'),
            new OA\Response(response: 401, description: 'No autenticado'),
            new OA\Response(response: 403, description: 'No autorizado'),
            new OA\Response(response: 404, description: 'Usuario no encontrado'),
        ]
    )]
    public function show(Request $request, User $user)
    {
        if (!$this->authorizeUserAccess($request, $user)) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        return response()->json(new UserResource($user));
    }
    #[OA\Put(
        path: '/api/users/{id}',
        summary: 'Actualizar perfil de usuario',
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
        ],
        requestBody: new OA\RequestBody(
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'name', type: 'string', example: 'Nuevo nombre'),
                    new OA\Property(property: 'email', type: 'string', example: 'nuevo@email.com'),
                    new OA\Property(property: 'password', type: 'string', example: 'newpassword123'),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Usuario actualizado'),
            new OA\Response(response: 401, description: 'No autenticado'),
            new OA\Response(response: 403, description: 'No autorizado'),
            new OA\Response(response: 422, description: 'Error de validación'),
        ]
    )]
    public function update(UpdateUserRequest $request, User $user)
    {
        if (!$this->authorizeUserAccess($request, $user)) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $user->update($request->validated());
        return response()->json(new UserResource($user));
    }
     #[OA\Delete(
        path: '/api/users/{id}',
        summary: 'Eliminar usuario',
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
        ],
        responses: [
            new OA\Response(response: 200, description: 'Usuario eliminado'),
            new OA\Response(response: 401, description: 'No autenticado'),
            new OA\Response(response: 403, description: 'No autorizado'),
            new OA\Response(response: 404, description: 'Usuario no encontrado'),
        ]
    )]
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

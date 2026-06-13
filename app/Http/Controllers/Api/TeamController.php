<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Http\Resources\TeamResource;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use OpenApi\Attributes as OA;

class TeamController extends Controller
{
    #[OA\Get(
    path: '/api/teams',
    summary: 'Lista todos los equipos',
    security: [['bearerAuth' => []]],
    responses: [
        new OA\Response(response: 200, description: 'Lista de equipos'),
        new OA\Response(response: 401, description: 'No autenticado'),
    ]
)]
    public function index()
    {
        return TeamResource::collection(Team::all());
    }
    #[OA\Post(
    path: '/api/teams',
    summary: 'Crear equipo (solo admin)',
    security: [['bearerAuth' => []]],
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'name', type: 'string', example: 'España'),
                new OA\Property(property: 'flag', type: 'string', example: 'https://flagcdn.com/es.svg'),
            ]
        )
    ),
    responses: [
        new OA\Response(response: 201, description: 'Equipo creado'),
        new OA\Response(response: 401, description: 'No autenticado'),
        new OA\Response(response: 403, description: 'No autorizado'),
        new OA\Response(response: 422, description: 'Error de validación'),
    ]
)]
    public function store(StoreTeamRequest $request)
    {
        $team = Team::create($request->validated());
        return response()->json(new TeamResource($team), 201);
    }
    #[OA\Put(
    path: '/api/teams/{team}',
    summary: 'Actualizar equipo (solo admin)',
    security: [['bearerAuth' => []]],
    parameters: [
        new OA\Parameter(name: 'team', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
    ],
    requestBody: new OA\RequestBody(
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'name', type: 'string', example: 'España'),
                new OA\Property(property: 'flag', type: 'string', example: 'https://flagcdn.com/es.svg'),
            ]
        )
    ),
    responses: [
        new OA\Response(response: 200, description: 'Equipo actualizado'),
        new OA\Response(response: 401, description: 'No autenticado'),
        new OA\Response(response: 403, description: 'No autorizado'),
        new OA\Response(response: 404, description: 'Equipo no encontrado'),
    ]
)]
    public function update(UpdateTeamRequest $request, Team $team)
    {
        $team->update($request->validated());
        return response()->json(new TeamResource($team));
    }
    #[OA\Delete(
    path: '/api/teams/{team}',
    summary: 'Eliminar equipo (solo admin)',
    security: [['bearerAuth' => []]],
    parameters: [
        new OA\Parameter(name: 'team', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
    ],
    responses: [
        new OA\Response(response: 200, description: 'Equipo eliminado'),
        new OA\Response(response: 401, description: 'No autenticado'),
        new OA\Response(response: 403, description: 'No autorizado'),
        new OA\Response(response: 404, description: 'Equipo no encontrado'),
    ]
)]
    public function destroy(Team $team)
    {
        $team->delete();
        return response()->json(['message' => 'Equipo eliminado'], 200);
    }
}

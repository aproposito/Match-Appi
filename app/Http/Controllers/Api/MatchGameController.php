<?php

namespace App\Http\Controllers\Api;

use App\Events\MatchResultRecorded;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\MatchGameResource;
use App\Models\MatchGame;
use App\Http\Requests\StoreMatchRequest;
use App\Http\Requests\UpdateMatchRequest;
use OpenApi\Attributes as OA;


class MatchGameController extends Controller
{
    #[OA\Get(
    path: '/api/matches',
    summary: 'Lista partidos (admin: todos, user: próximos)',
    security: [['bearerAuth' => []]],
    responses: [
        new OA\Response(response: 200, description: 'Lista de partidos'),
        new OA\Response(response: 401, description: 'No autenticado'),
    ]
)]
    public function index(Request $request)
    {
        if ($request->user()->role === 'admin') {
            $matches = MatchGame::all();
        } else {
            $matches = MatchGame::whereBetween('match_date_time', [
                now()->startOfDay(),
                now()->addDay()->setTime(8, 0, 0),
            ])->get();
        }

        return MatchGameResource::collection($matches);
    }
    #[OA\Post(
    path: '/api/matches',
    summary: 'Crear partido (solo admin)',
    security: [['bearerAuth' => []]],
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'home_team_id', type: 'integer', example: 1),
                new OA\Property(property: 'away_team_id', type: 'integer', example: 2),
                new OA\Property(property: 'phase', type: 'string', example: 'groups'),
                new OA\Property(property: 'match_date_time', type: 'string', example: '2026-06-22 23:00:00'),
                new OA\Property(property: 'final_home_goals', type: 'integer', example: 2),
                new OA\Property(property: 'final_away_goals', type: 'integer', example: 1),
            ]
        )
    ),
    responses: [
        new OA\Response(response: 201, description: 'Partido creado'),
        new OA\Response(response: 401, description: 'No autenticado'),
        new OA\Response(response: 403, description: 'No autorizado'),
        new OA\Response(response: 422, description: 'Error de validación'),
    ]
)]
    public function store(StoreMatchRequest $request)
    {
        $match = MatchGame::create($request->validated());
        return response()->json(new MatchGameResource($match), 201);
    }
    #[OA\Put(
    path: '/api/matches/{matchGame}',
    summary: 'Actualizar partido (solo admin)',
    security: [['bearerAuth' => []]],
    parameters: [
        new OA\Parameter(name: 'matchGame', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
    ],
    requestBody: new OA\RequestBody(
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'home_team_id', type: 'integer', example: 1),
                new OA\Property(property: 'away_team_id', type: 'integer', example: 2),
                new OA\Property(property: 'phase', type: 'string', example: 'groups'),
                new OA\Property(property: 'match_date_time', type: 'string', example: '2026-06-22 23:00:00'),
                new OA\Property(property: 'final_home_goals', type: 'integer', example: 2),
                new OA\Property(property: 'final_away_goals', type: 'integer', example: 1),
            ]
        )
    ),
    responses: [
        new OA\Response(response: 200, description: 'Partido actualizado'),
        new OA\Response(response: 401, description: 'No autenticado'),
        new OA\Response(response: 403, description: 'No autorizado'),
        new OA\Response(response: 404, description: 'Partido no encontrado'),
    ]
)]
    public function update(UpdateMatchRequest $request, MatchGame $matchGame)
    {
        $matchGame->update($request->validated());
        if ($matchGame->final_home_goals !== null && $matchGame->final_away_goals !== null) {
            MatchResultRecorded::dispatch($matchGame);
        }
        return response()->json(new MatchGameResource($matchGame));
    }
    #[OA\Delete(
    path: '/api/matches/{matchGame}',
    summary: 'Eliminar partido (solo admin)',
    security: [['bearerAuth' => []]],
    parameters: [
        new OA\Parameter(name: 'matchGame', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
    ],
    responses: [
        new OA\Response(response: 200, description: 'Partido eliminado'),
        new OA\Response(response: 401, description: 'No autenticado'),
        new OA\Response(response: 403, description: 'No autorizado'),
        new OA\Response(response: 404, description: 'Partido no encontrado'),
    ]
)]
    public function destroy(MatchGame $matchGame)
    {
        $matchGame->delete();
        return response()->json(['message' => 'Partido eliminado'], 200);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChampionPredictionRequest;
use App\Http\Requests\UpdateChampionPredictionRequest;
use App\Http\Resources\ChampionPredictionResource;
use App\Models\ChampionPrediction;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;



class ChampionPredictionController extends Controller
{
    #[OA\Get(
    path: '/api/champion-predictions',
    summary: 'Lista predicciones de campeón (admin: todas, user: la suya)',
    security: [['bearerAuth' => []]],
    responses: [
        new OA\Response(response: 200, description: 'Lista de predicciones de campeón'),
        new OA\Response(response: 401, description: 'No autenticado'),
    ]
)]
    public function index(Request $request)
    {
        if ($request->user()->role === 'admin') {
            $predictions = ChampionPrediction::all();
        } else {
            $predictions = ChampionPrediction::where('user_id', $request->user()->id)->get();
        }

        return ChampionPredictionResource::collection($predictions);
    }
    #[OA\Post(
    path: '/api/champion-predictions',
    summary: 'Crear predicción de campeón (solo user, durante fase de grupos)',
    security: [['bearerAuth' => []]],
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'team_id', type: 'integer', example: 1),
            ]
        )
    ),
    responses: [
        new OA\Response(response: 201, description: 'Predicción de campeón creada'),
        new OA\Response(response: 401, description: 'No autenticado'),
        new OA\Response(response: 403, description: 'No autorizado'),
        new OA\Response(response: 422, description: 'Error de validación o fase de grupos terminada'),
    ]
)]
    public function store(StoreChampionPredictionRequest $request)
    {
        $prediction = ChampionPrediction::create([
            'user_id' => $request->user()->id,
            'team_id' => $request->team_id,
        ]);

        return response()->json(new ChampionPredictionResource($prediction), 201);
    }
    #[OA\Put(
    path: '/api/champion-predictions/{championPrediction}',
    summary: 'Actualizar predicción de campeón (solo propietario, durante fase de grupos)',
    security: [['bearerAuth' => []]],
    parameters: [
        new OA\Parameter(name: 'championPrediction', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
    ],
    requestBody: new OA\RequestBody(
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'team_id', type: 'integer', example: 2),
            ]
        )
    ),
    responses: [
        new OA\Response(response: 200, description: 'Predicción de campeón actualizada'),
        new OA\Response(response: 401, description: 'No autenticado'),
        new OA\Response(response: 403, description: 'No autorizado'),
        new OA\Response(response: 422, description: 'Fase de grupos terminada'),
    ]
)]
    public function update(UpdateChampionPredictionRequest $request, ChampionPrediction $championPrediction)
    {
        $championPrediction->update($request->validated());
        return response()->json(new ChampionPredictionResource($championPrediction));
    }
    #[OA\Delete(
    path: '/api/champion-predictions/{championPrediction}',
    summary: 'Eliminar predicción de campeón (propietario o admin)',
    security: [['bearerAuth' => []]],
    parameters: [
        new OA\Parameter(name: 'championPrediction', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
    ],
    responses: [
        new OA\Response(response: 200, description: 'Predicción de campeón eliminada'),
        new OA\Response(response: 401, description: 'No autenticado'),
        new OA\Response(response: 403, description: 'No autorizado'),
        new OA\Response(response: 404, description: 'Predicción no encontrada'),
    ]
)]
    public function destroy(Request $request, ChampionPrediction $championPrediction)
    {
        if ($request->user()->role !== 'admin' && $request->user()->id !== $championPrediction->user_id) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $championPrediction->delete();
        return response()->json(['message' => 'Predicción de campeón eliminada']);
    }
}

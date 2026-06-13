<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMatchPredictionRequest;
use Illuminate\Http\Request;
use App\Http\Resources\MatchPredictionResource;
use App\Models\MatchPrediction;
use App\Http\Requests\UpdateMatchPredictionRequest;
use OpenApi\Attributes as OA;


class MatchPredictionController extends Controller
{
    #[OA\Get(
    path: '/api/match-predictions',
    summary: 'Lista predicciones (admin: todas, user: las suyas)',
    security: [['bearerAuth' => []]],
    responses: [
        new OA\Response(response: 200, description: 'Lista de predicciones'),
        new OA\Response(response: 401, description: 'No autenticado'),
    ]
)]
    public function index(Request $request)
    {
        if ($request->user()->role === 'admin') {
            $predictions = MatchPrediction::all();
        } else {
            $predictions = MatchPrediction::where('user_id', $request->user()->id)->get();
        }
        return MatchPredictionResource::collection($predictions);
    }
    #[OA\Post(
    path: '/api/match-predictions',
    summary: 'Crear predicción de partido (solo user)',
    security: [['bearerAuth' => []]],
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'match_id', type: 'integer', example: 1),
                new OA\Property(property: 'predicted_home_goals', type: 'integer', example: 2),
                new OA\Property(property: 'predicted_away_goals', type: 'integer', example: 1),
            ]
        )
    ),
    responses: [
        new OA\Response(response: 201, description: 'Predicción creada'),
        new OA\Response(response: 401, description: 'No autenticado'),
        new OA\Response(response: 403, description: 'No autorizado'),
        new OA\Response(response: 422, description: 'Error de validación o partido ya empezado'),
    ]
)]
    public function store(StoreMatchPredictionRequest $request)
    {
        $prediction = MatchPrediction::create([
            'match_id' => $request->match_id,
            'user_id' => $request->user()->id,
            'predicted_home_goals' => $request->predicted_home_goals,
            'predicted_away_goals' => $request->predicted_away_goals,
        ]);

        return response()->json(new MatchPredictionResource($prediction), 201);
    }
    #[OA\Put(
    path: '/api/match-predictions/{matchPrediction}',
    summary: 'Actualizar predicción (solo propietario)',
    security: [['bearerAuth' => []]],
    parameters: [
        new OA\Parameter(name: 'matchPrediction', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
    ],
    requestBody: new OA\RequestBody(
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'predicted_home_goals', type: 'integer', example: 2),
                new OA\Property(property: 'predicted_away_goals', type: 'integer', example: 1),
            ]
        )
    ),
    responses: [
        new OA\Response(response: 200, description: 'Predicción actualizada'),
        new OA\Response(response: 401, description: 'No autenticado'),
        new OA\Response(response: 403, description: 'No autorizado'),
        new OA\Response(response: 422, description: 'Partido ya empezado'),
    ]
)]
    public function update(UpdateMatchPredictionRequest $request, MatchPrediction $matchPrediction)
    {
        $matchPrediction->update($request->validated());
        return response()->json(new MatchPredictionResource($matchPrediction));
    }
    #[OA\Delete(
    path: '/api/match-predictions/{matchPrediction}',
    summary: 'Eliminar predicción (propietario o admin)',
    security: [['bearerAuth' => []]],
    parameters: [
        new OA\Parameter(name: 'matchPrediction', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
    ],
    responses: [
        new OA\Response(response: 200, description: 'Predicción eliminada'),
        new OA\Response(response: 401, description: 'No autenticado'),
        new OA\Response(response: 403, description: 'No autorizado'),
        new OA\Response(response: 404, description: 'Predicción no encontrada'),
    ]
)]
    public function destroy(Request $request, MatchPrediction $matchPrediction)
    {
        if ($request->user()->role !== 'admin' && $request->user()->id !== $matchPrediction->user_id) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $matchPrediction->delete();
        return response()->json(['message' => 'Predicción eliminada']);
    }
}

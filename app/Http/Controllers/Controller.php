<?php

namespace App\Http\Controllers;
use OpenApi\Attributes as OA;

#[OA\Info(
    title: 'Match-Appi API',
    version: '1.0.0',
    description: 'API REST para la porra del Mundial 2026'
)]
#[OA\SecurityScheme(
    securityScheme: 'bearerAuth',
    type: 'http',
    scheme: 'bearer'
)]
abstract class Controller
{
    
}

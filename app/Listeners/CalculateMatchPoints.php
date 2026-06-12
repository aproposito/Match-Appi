<?php

namespace App\Listeners;

use App\Events\MatchResultRecorded;
use App\Services\PointsCalculatorService;

class CalculateMatchPoints
{
    public function __construct(private PointsCalculatorService $calculator)
    {
        //
    }

    public function handle(MatchResultRecorded $event): void
    {
        $this->calculator->calculate($event->match);
    }
}


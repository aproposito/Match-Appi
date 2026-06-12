<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Events\MatchResultRecorded;
use App\Listeners\CalculateMatchPoints;
use Illuminate\Support\Facades\Event;

class AppServiceProvider extends ServiceProvider
{
public function boot(): void
{
    Event::listen(
        MatchResultRecorded::class,
        CalculateMatchPoints::class,
    );
}
}

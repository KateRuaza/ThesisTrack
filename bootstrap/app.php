<?php

use App\Jobs\MarkOverdueBorrowsJob;
use App\Jobs\NotifyDueBorrowersJob;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Console\Scheduling\Schedule;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);

        //
    })
    ->withSchedule(function (Schedule $schedule) {
        $schedule->job(new NotifyDueBorrowersJob())->dailyAt('7:00');
        $schedule->job(new MarkOverdueBorrowsJob())->dailyAt('7:00');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

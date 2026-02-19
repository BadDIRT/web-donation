<?php

use App\Http\Middleware\EnsurePengelolaApproved;
use App\Http\Middleware\RedirectIfAuthenticatedCustom;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
        'role' => RoleMiddleware::class,
        'guest.custom' => RedirectIfAuthenticatedCustom::class,
        'approved' => EnsurePengelolaApproved::class,
    ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

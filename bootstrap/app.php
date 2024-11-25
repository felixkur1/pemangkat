<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Auth;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin'=>\App\Http\Middleware\AdminMiddleware::class,
            'author'=>\App\Http\Middleware\AuthorMiddleware::class
        ]);
        $middleware->redirectUsersTo(fn () => Auth::user()?->role === "admin" ? route('beranda.index.admin') : route('artikel.index.author'));
        // $middleware->redirectUsersTo(function () {
        //     if (Auth::user()?->role == 'admin') {
        //         return route('beranda.index.admin');
        //     } else {
        //         return route('artikel.index.author');
        //     }
        // });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

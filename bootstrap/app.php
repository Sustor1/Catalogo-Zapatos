<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Si se intenta consultar, editar o eliminar un zapato que no existe,
        // se regresa al catálogo con un mensaje en lugar de mostrar un error 404.
        $exceptions->render(function (NotFoundHttpException $e, $request) {
            if ($request->is('zapatos/*')) {
                return redirect()->route('zapatos.index')
                    ->with('error', 'El zapato solicitado no existe o ya fue eliminado.');
            }
        });
    })->create();

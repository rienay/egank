<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Session\TokenMismatchException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Jurus pamungkas: Bypass validasi CSRF khusus untuk rute Autentikasi
        // Biar nggak kena 419 Page Expired terus di local/Laragon
        $middleware->validateCsrfTokens(except: [
            'login',
            'register',
            'logout',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Ubah error 419 menjadi redirect yang lebih ramah pengguna.
        $exceptions->render(function (TokenMismatchException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Sesi Anda berakhir. Silakan muat ulang dan coba lagi.'], 419);
            }

            return redirect()
                ->route('login.form')
                ->with('error', 'Sesi berakhir (419). Silakan login kembali.');
        });
    })->create();

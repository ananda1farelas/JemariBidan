<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     * Cek apakah user yang login adalah admin
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect('/')->with('login_error', 'Silakan login terlebih dahulu.');
        }

        if (!auth()->user()->isAdmin()) {
            return redirect()->route('user.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke halaman admin.');
        }

        return $next($request);
    }
}
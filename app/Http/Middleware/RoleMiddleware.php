<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Cek apakah user login dan memiliki role yang sesuai
        if (!auth()->check()) {
            return redirect('login');
        }

        // Logika khusus: Jika butuh 'seller', cek flag is_seller
        if ($role == 'seller' && !auth()->user()->is_seller) {
            abort(403, 'Anda bukan seller.');
        }

        // Logika admin
        if ($role == 'admin' && auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Halaman ini khusus Admin.');
        }

        return $next($request);
    }
}

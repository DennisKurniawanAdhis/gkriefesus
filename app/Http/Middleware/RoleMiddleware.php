<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check() || !in_array(Auth::user()->role, $roles)) {
            // Jika pengguna tidak memiliki peran yang sesuai, arahkan ke halaman lain
            return redirect()->route('home'); // Ganti dengan route yang sesuai
        }

        return $next($request);
    }
}

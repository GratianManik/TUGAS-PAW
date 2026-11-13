<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekRole
{
    /**
     * Pemakaian di route: ->middleware('role:admin') atau 'role:admin,staff'
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (!$user || !in_array($user->role, $roles, true)) {
            abort(403, 'Anda tidak punya hak akses untuk halaman ini.');
        }

        return $next($request);
    }
}

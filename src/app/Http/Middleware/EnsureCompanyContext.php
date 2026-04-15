<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureCompanyContext
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        if (!$user->company_id) {
            return response()->json([
                'message' => 'Usuário sem empresa vinculada'
            ], 403);
        }

        return $next($request);
    }
}
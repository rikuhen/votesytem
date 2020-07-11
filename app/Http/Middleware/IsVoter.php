<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsVoter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user->role == 'voter' && $user->enabled) {
            return $next($request);
        }

        return response()->json(['message' => 'No permitido'], 411);

    }
}

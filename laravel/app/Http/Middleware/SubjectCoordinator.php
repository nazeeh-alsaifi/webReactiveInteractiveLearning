<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SubjectCoordinator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        if(empty($user) || !$user->hasRole('subject_coordinator')){
            return response()->json(['message' => 'Unauthenticated. subject_coordinator role required'], 401);
        }
        return $next($request);
    }
}

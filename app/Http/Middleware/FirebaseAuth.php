<?php

namespace App\Http\Middleware;

use App\Services\Api\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Symfony\Component\HttpFoundation\Response;

class FirebaseAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        try {
            if (!$request->bearerToken()) {
                return ApiResponse::unauthorized(__('auth.authentication_failed'));
            }
            $verifiedIdToken = Firebase::auth()->verifyIdToken($request->bearerToken());
            $userId = $verifiedIdToken->claims()->get('sub');
        } catch (\Exception $e) {
            return ApiResponse::unauthorized(__('auth.unauthentication'));
        }

        return $next($request);
    }

}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;

class CustomThrottleMiddleware
{
    protected $rateLimiter;

    public function __construct(RateLimiter $rateLimiter)
    {
        $this->rateLimiter = $rateLimiter;
    }

    public function handle(Request $request, Closure $next, $maxAttempts = 60, $decayMinutes = 1): Response
    {
        $key = $request->ip();

        if ($this->rateLimiter->tooManyAttempts($key, $maxAttempts)) {
            return response()->json(['success' => false, 'msg' => 'Muitas tentativas.', Response::HTTP_TOO_MANY_REQUESTS]);
        }

        $this->rateLimiter->hit($key, $decayMinutes = 60);

        $response = $next($request);

        return $response;
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AppendRateLimitInfoMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (!$response instanceof JsonResponse) {
            return $response;
        }

        $limit = $response->headers->get('X-RateLimit-Limit');
        $remaining = $response->headers->get('X-RateLimit-Remaining');
        $retryAfter = $response->headers->get('Retry-After');

        $data = $response->getData(true);
        $data['rate_limit'] =  [
            'limit' => $limit !== null ? (int) $limit : null,
            'remaining' => $remaining !== null ? (int) $remaining : null,
            'retry_after' => $retryAfter !== null ? (int) $retryAfter : null,
        ];

        return $response->setData($data);
    }
}

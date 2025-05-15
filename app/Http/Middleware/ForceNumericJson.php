<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;
class ForceNumericJson
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
    $response = $next($request);

        if ($response instanceof JsonResponse) {
            $data = $response->getData(true); // convert to array
            $status = $response->getStatusCode();
            $headers = $response->headers->all();

            return response()->json($data, $status, $headers, JSON_NUMERIC_CHECK);
        }

        return $response;
    }
}

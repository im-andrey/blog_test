<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ThrottleArticleViews
{
    protected int $timeFrame;

    protected int $limit;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $maxAttempts = 5, $decayMinutes = 1): Response
    {
        $this->timeFrame = $decayMinutes;
        $this->limit = $maxAttempts;

        $sessionId = $request->session()->getId();

        $requestCount = $request->session()->get("article_views_{$sessionId}_count", 0);
        $lastRequestTime = $request->session()->get("article_views_{$sessionId}_time", now());

        if ($lastRequestTime->diffInMinutes(now()) >= $this->timeFrame) {
            $requestCount = 0;
        }

        if ($requestCount >= $this->limit) {
            return response()->json(['message' => 'Превышен лимит запросов'], Response::HTTP_TOO_MANY_REQUESTS);
        }

        $request->session()->put("article_views_{$sessionId}_count", $requestCount + 1);
        $request->session()->put("article_views_{$sessionId}_time", now());  // Обновляем время последнего запроса

        return $next($request);
    }

}

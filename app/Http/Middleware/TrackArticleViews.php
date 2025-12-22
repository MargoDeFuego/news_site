<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ArticleView;

class TrackArticleViews
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($request->route('article')) {
            ArticleView::create([
                'article_id' => $request->route('article')->id,
                'url'        => $request->fullUrl(),
                'ip'         => $request->ip(),
            ]);
        }

        return $response;
    }
}

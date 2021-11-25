<?php

namespace SPatompong\LaravelRoutesHtml\Middlewares;

use Closure;
use Illuminate\Http\Request;

class PackageEnabled
{
    public function handle(Request $request, Closure $next)
    {
        // Return 404 not found if the package is disabled
        if (! config('routes-html.enabled')) {
            abort(404);
        }

        return $next($request);
    }
}

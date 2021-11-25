<?php

namespace SPatompong\LaravelRoutesHtml\Tests\stubs\Middlewares;

use Closure;
use Illuminate\Http\Request;

class HasSecretParam
{
    public function handle(Request $request, Closure $next)
    {
        $secret = $request->input('secret');

        if (is_null($secret)) {
            abort(403);
        }

        if ((int) $secret !== 1) {
            abort(403);
        }

        return $next($request);
    }
}

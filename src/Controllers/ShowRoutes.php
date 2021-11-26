<?php

namespace SPatompong\LaravelRoutesHtml\Controllers;

use Closure;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Route;
use Illuminate\Routing\Router;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\View\View;
use SPatompong\LaravelRoutesHtml\Middlewares\PackageEnabled;

class ShowRoutes extends Controller
{
    protected array $headers = ['Domain', 'Method', 'URI', 'Name', 'Action', 'Middleware'];

    protected array $ignoreRoutes;

    public function __construct(protected Router $router)
    {
        // By default, let the request run through
        // the PackageEnabled middleware
        $this->middleware(PackageEnabled::class);

        // Then, append the middleware pipeline
        // with the middlewares from the config file
        foreach (config('routes-html.middlewares') as $middleware) {
            $this->middleware($middleware);
        }

        $this->ignoreRoutes = config('routes-html.ignore_routes');
    }

    public function __invoke(): View
    {
        $this->router->flushMiddlewareGroups();

        // Convert all \n into <br>
        $routes = array_values(array_map(function (array $route) {
            $route['middleware'] = nl2br($route['middleware']);

            if (empty(trim($route['middleware']))) {
                $route['middleware'] = '-';
            }

            return $route;
        }, $this->getRoutes()));

        return view('routes-html::routes', compact('routes'));
    }

    // All the methods below are the stripped-down
    // version of the codebase from the
    // Laravel's route:list command

    /**
     * Compile the routes into a displayable format.
     *
     * @return array
     */
    protected function getRoutes(): array
    {
        $routes = collect($this->router->getRoutes())->map(function ($route) {
            return $this->getRouteInformation($route);
        })->filter()->all();

        return $this->pluckColumns($routes);
    }

    /**
     * Remove unnecessary columns from the routes.
     *
     * @param  array  $routes
     * @return array
     */
    protected function pluckColumns(array $routes): array
    {
        return array_map(function ($route) {
            return Arr::only($route, $this->getColumns());
        }, $routes);
    }

    /**
     * Get the table headers for the visible columns.
     *
     * @return array
     */
    protected function getHeaders(): array
    {
        return Arr::only($this->headers, array_keys($this->getColumns()));
    }

    /**
     * Get the column names to show (lowercase table headers).
     *
     * @return array
     */
    protected function getColumns(): array
    {
        $availableColumns = array_map('strtolower', $this->headers);

        return $availableColumns;
    }

    /**
     * Get the route information for a given route.
     *
     * @param  \Illuminate\Routing\Route  $route
     * @return array
     */
    protected function getRouteInformation(Route $route): array
    {
        return $this->filterRoute([
            'domain' => $route->domain(),
            'method' => implode('|', $route->methods()),
            'uri' => $route->uri(),
            'name' => $route->getName(),
            'action' => ltrim($route->getActionName(), '\\'),
            'middleware' => $this->getRouteMiddleware($route),
        ]);
    }

    /**
     * Filter the route by URI and / or name.
     *
     * @param  array  $route
     * @return array
     */
    protected function filterRoute(array $route): array
    {
        foreach ($this->ignoreRoutes as $ignoreRoute) {
            if (Str::is($ignoreRoute, $route['uri'])) {
                return [];
            }
        }

        return $route;
    }

    /**
     * Get the middleware for the route.
     *
     * @param  \Illuminate\Routing\Route  $route
     * @return string
     */
    protected function getRouteMiddleware($route): string
    {
        return collect($this->router->gatherRouteMiddleware($route))->map(function ($middleware) {
            return $middleware instanceof Closure ? 'Closure' : $middleware;
        })->implode("\n");
    }

    /**
     * Parse the column list.
     *
     * @param  array  $columns
     * @return array
     */
    protected function parseColumns(array $columns): array
    {
        $results = [];

        foreach ($columns as $i => $column) {
            if (Str::contains($column, ',')) {
                $results = array_merge($results, explode(',', $column));
            } else {
                $results[] = $column;
            }
        }

        return array_map('strtolower', $results);
    }
}

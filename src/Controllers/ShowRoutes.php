<?php

namespace SPatompong\LaravelRoutesHtml\Controllers;

use Closure;
use Illuminate\Routing\Route;
use Illuminate\Routing\Router;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ShowRoutes
{
    protected array $headers = ['Domain', 'Method', 'URI', 'Name', 'Action', 'Middleware'];

    protected array $ignoreRoutes;

    public function __construct(protected Router $router)
    {
        $this->ignoreRoutes = config('routes-html.ignore_routes');
    }

    public function __invoke()
    {
        $routes = array_values($this->getRoutes());

        return view('routes-html::routes', compact('routes'));
    }

    protected function getRoutes(): array
    {
        $routes = collect($this->router->getRoutes())->map(function ($route) {
            return $this->getRouteInformation($route);
        })->filter()->all();

        return $this->pluckColumns($routes);
    }

    protected function pluckColumns(array $routes): array
    {
        return array_map(function ($route) {
            return Arr::only($route, $this->getColumns());
        }, $routes);
    }

    protected function getHeaders(): array
    {
        return Arr::only($this->headers, array_keys($this->getColumns()));
    }

    protected function getColumns(): array
    {
        $availableColumns = array_map('strtolower', $this->headers);

        return $availableColumns;
    }

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

    protected function filterRoute(array $route): array|bool
    {
        foreach ($this->ignoreRoutes as $ignoreRoute) {
            if (Str::is($ignoreRoute, $route['uri'])) {
                return [];
            }
        }

        return $route;
    }

    protected function getRouteMiddleware($route): string
    {
        return collect($this->router->gatherRouteMiddleware($route))->map(function ($middleware) {
            return $middleware instanceof Closure ? 'Closure' : $middleware;
        })->implode("\n");
    }

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

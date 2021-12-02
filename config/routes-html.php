<?php

return [
    /**
     * Either you want to enable or disable the route
     * It should be enabled only in the local environment
     * By default, it'll be enabled if the app.debug is true
     */
    'enabled' => (bool) env('ROUTES_HTML_ENABLED', config('app.debug')),

    /**
     * The route URI
     */
    'uri' => '/route-list',

    /**
     * The route name
     */
    'route_name' => 'routes',

    /**
     * The list of route to ignore
     */
    'ignore_routes' => [
        'route-list/*',
        '_ignition/*',
        'sanctum/*',
        'livewire/*',
    ],

    /**
     * The list of middleware that you want
     * the request to run through before hitting
     * the /route-list route
     */
    'middlewares' => [
        // Example: uncomment the first line below
        // to allow only the authenticated user
        // to use the /route-list route

        // \App\Http\Middleware\Authenticate::class
    ],
];

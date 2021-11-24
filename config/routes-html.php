<?php

return [
    /**
     * The route
     */
    'route' => '/route-list',

    /**
     * The route name
     */
    'route_name' => 'routes',

    'ignore_routes' => [
        'routes-html/*',
        '_ignition/*',
        'sanctum/*',
    ],
];

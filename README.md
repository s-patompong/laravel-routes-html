# View your Laravel routes on the browser 🏖

[![Latest Version on Packagist](https://img.shields.io/packagist/v/s-patompong/laravel-routes-html.svg?style=flat-square)](https://packagist.org/packages/s-patompong/laravel-routes-html)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/s-patompong/laravel-routes-html/run-tests?label=tests)](https://github.com/s-patompong/laravel-routes-html/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/s-patompong/laravel-routes-html/Check%20&%20fix%20styling?label=code%20style)](https://github.com/s-patompong/laravel-routes-html/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/s-patompong/laravel-routes-html.svg?style=flat-square)](https://packagist.org/packages/s-patompong/laravel-routes-html)

This package adds a route to your Laravel application. Once you've installed this package, enter `/route-list` path in the browser to see your route list.

https://user-images.githubusercontent.com/3887531/143555171-63bcabfc-11e3-4673-91cd-b06df5fa0021.mov

The page also allows you to filter using the URI and Name.

## Features
- See all routes in your Laravel application in a nicely formatted table with responsive layout.
- Sort routes by domain, method, uri, name, action, and middleware.
- Quickly filter to see only the routes that you want. 🎉
- Click on the GET|HEAD route to open it on a new tab. You need to specify the parameters if the route requires them. 😎

## Installation

You can install the package via composer:

```bash
composer require s-patompong/laravel-routes-html
```

You can publish the config file with:
```bash
php artisan vendor:publish --tag="routes-html-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="routes-html-views"
```

This is the contents of the published config file:

```php
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
        'routes-html/*',
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
```

## Usage

Open your Laravel application on the browser and go to `/route-list` URL (or the URL that you put inside the `routes-html.uri`).

![Screenshot](https://i.imgur.com/0W86LoF.png)

### Route Middlewares

To add middlewares to the request pipeline before it hits the `/route-list` route.
Add the middleware classname to the `middlewares` key in the config file like so:

```php
'middlewares' => [
    \App\Http\Middleware\Authenticate::class
]
```

This will make sure that only the authenticated user can access the `/route-list` route.  

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Patompong Savaengsuk](https://github.com/s-patompong)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

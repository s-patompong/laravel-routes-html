<?php

use function Pest\Laravel\get;

it('gets 404 error if the package is disabled', function () {
    config(['routes-html.enabled' => false]);

    get(config('routes-html.uri'))
        ->assertStatus(404);
});

it('can open the route list url when the package is enabled', function () {
    config(['routes-html.enabled' => true]);

    get(config('routes-html.uri'))
        ->assertStatus(200)
        ->assertSee(config('routes-html.route_name'));
});

<?php

use function Pest\Laravel\get;

it('can open the route list url', function () {
    get(config('routes-html.route'))
        ->assertStatus(200)
        ->assertSee(config('routes-html.route_name'));
});

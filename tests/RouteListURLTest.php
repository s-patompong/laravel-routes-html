<?php

use SPatompong\LaravelRoutesHtml\Tests\stubs\Middlewares\HasSecretParam;
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

it('allows user to set middlewares', function () {
    config(['routes-html.enabled' => true]);

    config(['routes-html.middlewares' => [
        HasSecretParam::class,
    ]]);

    $url = config('routes-html.uri');

    get($url)->assertStatus(403);
    get("$url?secret=2")->assertStatus(403);
    get("$url?secret=1")->assertStatus(200);
});

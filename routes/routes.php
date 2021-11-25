<?php

use Illuminate\Support\Facades\Route;
use SPatompong\LaravelRoutesHtml\Controllers\ShowRoutes;

Route::get(config('routes-html.uri'), ShowRoutes::class)
    ->name(config('routes-html.route_name'));

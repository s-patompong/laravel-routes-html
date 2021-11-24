<?php

namespace SPatompong\LaravelRoutesHtml\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \SPatompong\LaravelRoutesHtml\LaravelRoutesHtml
 */
class LaravelRoutesHtml extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-routes-html';
    }
}

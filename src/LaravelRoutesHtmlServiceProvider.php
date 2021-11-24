<?php

namespace SPatompong\LaravelRoutesHtml;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelRoutesHtmlServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-routes-html')
            ->hasConfigFile()
            ->hasViews()
            ->hasRoutes('routes');
    }
}

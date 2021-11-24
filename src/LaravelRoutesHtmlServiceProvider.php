<?php

namespace SPatompong\LaravelRoutesHtml;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use SPatompong\LaravelRoutesHtml\Commands\LaravelRoutesHtmlCommand;

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
            ->hasMigration('create_laravel-routes-html_table')
            ->hasCommand(LaravelRoutesHtmlCommand::class);
    }
}

<?php

namespace Squarebit\InvoiceXpress;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Squarebit\InvoiceXpress\Commands\InvoiceXpressCommand;

class InvoiceXpressServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('invoicexpress-for-laravel')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_invoicexpress-for-laravel_table')
            ->hasCommand(InvoiceXpressCommand::class);
    }
}

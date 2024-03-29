<?php

namespace Squarebit\InvoiceXpress;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
            ->hasConfigFile([
                'invoicexpress-for-laravel',
                'ix-endpoints',
            ])
            ->hasViews()
            ->hasMigrations([
                'create_ix_items_table',
                'create_ix_taxes_table',
                'create_ix_clients_table',
                'create_ix_invoices_table',
                'create_ix_estimates_table',
                'create_ix_guides_table',
                'create_ix_sequences_table',
            ])->runsMigrations();

    }
}

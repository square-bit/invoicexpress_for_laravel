<?php

namespace Squarebit\InvoiceXpress\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\LaravelData\LaravelDataServiceProvider;
use Squarebit\InvoiceXpress\InvoiceXpressServiceProvider;

class TestCase extends Orchestra
{
    protected array $data = [];

    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Squarebit\\InvoiceXpress\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );

        TEST_REAL_API === false && Http::preventStrayRequests()->fake([]);
    }

    protected function getPackageProviders($app)
    {
        return [
            InvoiceXpressServiceProvider::class,
            LaravelDataServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        //        config()->set('database.default', 'mysql');

        /*
        $migration = include __DIR__.'/../database/migrations/create_invoicexpress-for-laravel_table.php.stub';
        $migration->up();
        */
    }
}

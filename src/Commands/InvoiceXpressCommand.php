<?php

namespace Squarebit\InvoiceXpress\Commands;

use Illuminate\Console\Command;

class InvoiceXpressCommand extends Command
{
    public $signature = 'invoicexpress-for-laravel';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}

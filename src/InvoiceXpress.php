<?php

namespace Squarebit\InvoiceXpress;

use Squarebit\InvoiceXpress\API\Data\AccountConfig;
use Squarebit\InvoiceXpress\API\Endpoints\ClientsEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\EstimatesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\GuidesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\InvoicesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\ItemsEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\SaftEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\SequencesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\TaxesEndpoint;

class InvoiceXpress
{
    public const DATE_FORMAT = 'd/m/Y';

    public const DATE_TIME_FORMAT = 'd/m/Y H:i:s';

    protected ?AccountConfig $accountConfig = null;

    public function useConfig(AccountConfig $config): self
    {
        $this->accountConfig = $config;

        return $this;
    }

    public function clients(): ClientsEndpoint
    {
        return new ClientsEndpoint($this->accountConfig);
    }

    public function items(): ItemsEndpoint
    {
        return new ItemsEndpoint($this->accountConfig);
    }

    public function sequences(): SequencesEndpoint
    {
        return new SequencesEndpoint($this->accountConfig);
    }

    public function taxes(): TaxesEndpoint
    {
        return new TaxesEndpoint($this->accountConfig);
    }

    public function saft(): SaftEndpoint
    {
        return new SaftEndpoint($this->accountConfig);
    }

    public function invoices(): InvoicesEndpoint
    {
        return new InvoicesEndpoint($this->accountConfig);
    }

    public function guides(): GuidesEndpoint
    {
        return new GuidesEndpoint($this->accountConfig);
    }

    public function estimates(): EstimatesEndpoint
    {
        return new EstimatesEndpoint($this->accountConfig);
    }
}

<?php

namespace Squarebit\InvoiceXpress\API\Endpoints\Config;

use Exception;
use Squarebit\InvoiceXpress\API\Data\AccountConfig;

class EndpointConfig
{
    protected ?array $endpointData = null;

    public function __construct(
        protected AccountConfig $accountConfig,
        protected string $object,
        protected string $action,
    ) {
        throw_unless(
            is_array($cfg = EndpointsConfig::get($object.'.'.$action)),
            Exception::class,
            "Endpoints config '".$object.'.'.$action."' must be an array"
        );

        $this->endpointData = $cfg;
    }

    public function getMethod(): string
    {
        return $this->endpointData['method'];
    }

    public function getUrl(?array $queryParams = []): string
    {
        $queryParams = array_merge(
            ['api_key' => $this->accountConfig->apiKey],
            $queryParams
        );

        return 'https://'.
            $this->accountConfig->name.
            '.'.
            $this->accountConfig->serviceEndpoint.
            '/'.
            $this->endpointData['path'].
            '?'.
            http_build_query($queryParams);
    }
}

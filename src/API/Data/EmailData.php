<?php

namespace Squarebit\InvoiceXpress\API\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Squarebit\InvoiceXpress\API\Data\Transformers\BoolToIntTransformer;

#[MapName(SnakeCaseMapper::class)]
class EmailData extends Data
{
    public function __construct(
        public EmailClientData $client,
        public ?string $subject, // 'Invoice from company',
        public ?string $body, // 'This is where the email body goes',
        #[Email]
        public ?string $cc, // 'cc.client@company.com',
        #[Email]
        public ?string $bcc, // 'bcc.client@company.com',
        #[WithTransformer(BoolToIntTransformer::class)]
        public bool $logo = true, // '0/false' - Don't include logo, '1/true' - Include logo
    ) {
    }
}

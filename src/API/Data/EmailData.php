<?php

namespace Squarebit\InvoiceXpress\API\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Optional;
use Squarebit\InvoiceXpress\API\Data\Transformers\BoolToIntTransformer;

#[MapName(SnakeCaseMapper::class)]
class EmailData extends Data
{
    public function __construct(
        public EmailClientData $client,
        public Optional|string $subject, // 'Invoice from company',
        public Optional|string $body, // 'This is where the email body goes',
        #[Email]
        public Optional|string $cc, // 'cc.client@company.com',
        #[Email]
        public Optional|string $bcc, // 'bcc.client@company.com',
        #[WithTransformer(BoolToIntTransformer::class)]
        public bool $logo = true, // '0/false' - Don't include logo, '1/true' - Include logo
    ) {}

    public static function to(
        EmailClientData $client,
        ?string $subject = null,
        ?string $body = null,
        ?string $cc = null,
        ?string $bcc = null,
        bool $logo = true): self
    {
        return new self(
            client: $client,
            subject: $subject ?: Optional::create(),
            body: $body ?: Optional::create(),
            cc: $cc ?: Optional::create(),
            bcc: $bcc ?: Optional::create(),
            logo: $logo
        );
    }
}

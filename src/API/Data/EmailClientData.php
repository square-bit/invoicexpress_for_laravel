<?php

namespace Squarebit\InvoiceXpress\API\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Squarebit\InvoiceXpress\API\Data\Transformers\BoolToIntTransformer;

#[MapName(SnakeCaseMapper::class)]
class EmailClientData extends Data
{
    public function __construct(
        #[Email]
        public ?string $email,
        #[WithTransformer(BoolToIntTransformer::class)]
        public bool $save = false,
    ) {
    }

    public static function fromEmail(string $email): static
    {
        return new self(
            email: $email,
            save: false
        );
    }
}

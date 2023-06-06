<?php

namespace Squarebit\InvoiceXpress\API\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\RequiredIf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Optional;
use Squarebit\InvoiceXpress\API\Enums\DocumentEventEnum;

#[MapName(SnakeCaseMapper::class)]
class StateData extends Data
{
    public function __construct(
        public DocumentEventEnum $state,

        #[Required]
        #[RequiredIf('state', 'canceled')]
        public Optional|string $message,
    ) {
    }

    public static function event(DocumentEventEnum $event): self
    {
        return new self(state: $event, message: Optional::create());
    }
}

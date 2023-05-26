<?php

namespace Squarebit\InvoiceXpress\API\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\RequiredIf;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Squarebit\InvoiceXpress\API\Enums\DocumentEventEnum;

#[MapName(SnakeCaseMapper::class)]
class StateData extends EntityData
{
    public function __construct(
        public DocumentEventEnum $state,

        #[Required]
        #[RequiredIf('state', 'canceled')]
        public ?string $message,
    ) {
    }
}

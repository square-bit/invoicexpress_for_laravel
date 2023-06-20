<?php

namespace Squarebit\InvoiceXpress\API\Data;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Transformers\DateTimeInterfaceTransformer;
use Squarebit\InvoiceXpress\API\Enums\PaymentMechanismEnum;
use Squarebit\InvoiceXpress\InvoiceXpress;

#[MapName(SnakeCaseMapper::class)]
class PartialPaymentData extends Data
{
    public function __construct(
        #[Min(0)]
        public float $amount,
        #[WithCast(DateTimeInterfaceCast::class, format: InvoiceXpress::DATE_FORMAT)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: InvoiceXpress::DATE_FORMAT)]
        public Optional|Carbon $paymentDate,
        public Optional|PaymentMechanismEnum $paymentMechanism,
        public Optional|string $note,
        public Optional|string $serie,
    ) {
    }

    public static function of(float $amount, ?Carbon $date = null, ?PaymentMechanismEnum $mechanism = null): self
    {
        return new self(
            amount: $amount,
            paymentDate: $date ?? Optional::create(),
            paymentMechanism: $mechanism ?? Optional::create(),
            note: Optional::create(),
            serie: Optional::create()
        );
    }
}

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
use Spatie\LaravelData\Transformers\DateTimeInterfaceTransformer;
use Squarebit\InvoiceXpress\API\Data\Casts\PaymentMechanismCast;
use Squarebit\InvoiceXpress\API\Data\Transformers\EnumToNameTransformer;
use Squarebit\InvoiceXpress\API\Enums\PaymentMechanismEnum;
use Squarebit\InvoiceXpress\InvoiceXpress;

#[MapName(SnakeCaseMapper::class)]
class PartialPaymentData extends Data
{
    public function __construct(
        public ?string $note,

        public ?string $serie,

        #[Min(0)]
        public float $amount,

        #[WithCast(DateTimeInterfaceCast::class, format: InvoiceXpress::DATE_FORMAT)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: InvoiceXpress::DATE_FORMAT)]
        public ?Carbon $paymentDate,

        #[WithCast(PaymentMechanismCast::class)]
        #[WithTransformer(EnumToNameTransformer::class)]
        public PaymentMechanismEnum $paymentMechanism = PaymentMechanismEnum::TB,
    ) {
    }
}

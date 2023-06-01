<?php

namespace Squarebit\InvoiceXpress\API\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Optional;
use Squarebit\InvoiceXpress\API\Data\Transformers\BoolToIntTransformer;

#[MapName(SnakeCaseMapper::class)]
class SequenceData extends EntityData
{
    public function __construct(
        public Optional|int $id, // 146090,

        public string $serie, // 'SR2022',

        #[WithTransformer(BoolToIntTransformer::class)]
        public bool $defaultSequence, // 1,

        public Optional|int $currentInvoiceNumber, // 0,

        public Optional|int $currentInvoiceSequenceId, // 146090,

        public Optional|string $currentInvoiceValidationCode, // 'ABCD1230',

        public Optional|int $currentInvoiceReceiptNumber, // 0,

        public Optional|int $currentInvoiceReceiptSequenceId, // 146092,

        public Optional|string $currentInvoiceReceiptValidationCode, // 'ABCD1231',

        public Optional|int $currentSimplifiedInvoiceNumber, // 0,

        public Optional|int $currentSimplifiedInvoiceSequenceId, // 146091,

        public Optional|string $currentSimplifiedInvoiceValidationCode, // 'ABCD1232',

        public Optional|int $currentCreditNoteNumber, // 0,

        public Optional|int $currentCreditNoteSequenceId, // 146095,

        public Optional|string $currentCreditNoteValidationCode, // 'ABCD1233',

        public Optional|int $currentDebitNoteNumber, // 0,

        public Optional|int $currentDebitNoteSequenceId, // 146094,

        public Optional|string $currentDebitNoteValidationCode, // 'ABCD1234',

        public Optional|int $currentReceiptNumber, // 0,

        public Optional|int $currentReceiptSequenceId, // 146093,

        public Optional|string $currentReceiptValidationCode, // 'ABCD1235',

        public Optional|int $currentShippingNumber, // 0,

        public Optional|int $currentShippingSequenceId, // 146104,

        public Optional|string $currentShippingValidationCode, // 'ABCD1236',

        public Optional|int $currentTransportNumber, // 0,

        public Optional|int $currentTransportSequenceId, // 146106,

        public Optional|string $currentTransportValidationCode, // 'ABCD1237',

        public Optional|int $currentDevolutionNumber, // 0,

        public Optional|int $currentDevolutionSequenceId, // 146105,

        public Optional|string $currentDevolutionValidationCode, // 'ABCD1238',

        public Optional|int $currentProformaNumber, // 0,

        public Optional|int $currentProformaSequenceId, // 146102,

        public Optional|string $currentProformaValidationCode, // 'ABCD1239',

        public Optional|int $currentQuoteNumber, // 0,

        public Optional|int $currentQuoteSequenceId, // 146101,

        public Optional|string $currentQuoteValidationCode, // 'ABCD1240',

        public Optional|int $currentFeesNoteNumber, // 0,

        public Optional|int $currentFeesNoteSequenceId, // 146103,

        public Optional|string $currentFeesNoteValidationCode, // 'N/A',

        public Optional|int $currentVatMossInvoiceNumber, // 0,

        public Optional|int $currentVatMossInvoiceSequenceId, // 146097,

        public Optional|string $currentVatMossInvoiceValidationCode, // 'N/A',

        public Optional|int $currentVatMossCreditNoteNumber, // 0,

        public Optional|int $currentVatMossCreditNoteSequenceId, // 146098,

        public Optional|string $currentVatMossCreditNoteValidationCode, // 'N/A',

        public Optional|int $currentVatMossReceiptNumber, // 0,

        public Optional|int $currentVatMossReceiptSequenceId, // 146099

        public Optional|string $currentVatMossReceiptValidationCode, // 'N/A'
    ) {
    }
}

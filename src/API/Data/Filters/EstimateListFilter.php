<?php

namespace Squarebit\InvoiceXpress\API\Data\Filters;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Optional;
use Squarebit\InvoiceXpress\API\Data\Filters\Base\DateIntervalFilter;
use Squarebit\InvoiceXpress\API\Data\Filters\Base\NumberIntervalFilter;
use Squarebit\InvoiceXpress\API\Data\Filters\Base\PaginationFilter;
use Squarebit\InvoiceXpress\API\Data\Filters\Base\QueryFilter;
use Squarebit\InvoiceXpress\API\Data\Transformers\BoolToStringTransformer;

#[MapName(SnakeCaseMapper::class)]
class EstimateListFilter extends QueryFilter
{
    public function __construct(
        public Optional|string $text,

        /** @var Optional|array<\Squarebit\InvoiceXpress\Enums\EstimateTypeEnum> */
        public Optional|array $type,

        /** @var Optional|array<\Squarebit\InvoiceXpress\Enums\EstimateStatusEnum> */
        public Optional|array $status,

        public Optional|DateIntervalFilter $date,

        public Optional|DateIntervalFilter $dueDate,

        public Optional|NumberIntervalFilter $totalBeforeTaxes,

        #[WithTransformer(BoolToStringTransformer::class)]
        public Optional|bool $nonArchived,

        #[WithTransformer(BoolToStringTransformer::class)]
        public Optional|bool $archived,

        public Optional|string $reference,

        public Optional|PaginationFilter $pagination,
    ) {
    }
}

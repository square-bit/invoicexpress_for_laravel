<?php

namespace Squarebit\InvoiceXpress\API\Data\Filters;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Optional;
use Squarebit\InvoiceXpress\API\Data\Filters\Base\IntervalFilter;
use Squarebit\InvoiceXpress\API\Data\Filters\Base\PaginationFilter;
use Squarebit\InvoiceXpress\API\Data\Filters\Base\QueryFilter;
use Squarebit\InvoiceXpress\API\Data\Transformers\BoolToStringTransformer;
use Squarebit\InvoiceXpress\API\Enums\EstimateStatusEnum;
use Squarebit\InvoiceXpress\API\Enums\EstimateTypeEnum;

#[MapName(SnakeCaseMapper::class)]
class EstimateListFilter extends QueryFilter
{
    public function __construct(
        public Optional|string $text,

        /** @var Optional|array<EstimateTypeEnum> */
        public Optional|array $type,

        /** @var Optional|array<EstimateStatusEnum> */
        public Optional|array $status,

        public Optional|IntervalFilter $date,

        public Optional|IntervalFilter $dueDate,

        public Optional|IntervalFilter $totalBeforeTaxes,

        #[WithTransformer(BoolToStringTransformer::class)]
        public Optional|bool $nonArchived,

        #[WithTransformer(BoolToStringTransformer::class)]
        public Optional|bool $archived,

        public Optional|string $reference,

        public Optional|PaginationFilter $pagination,
    ) {
    }
}

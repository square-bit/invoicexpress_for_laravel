<?php

namespace Squarebit\InvoiceXpress\API\Data\Filters;

use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Optional;
use Squarebit\InvoiceXpress\API\Data\Filters\Base\DateIntervalFilter;
use Squarebit\InvoiceXpress\API\Data\Filters\Base\QueryFilter;
use Squarebit\InvoiceXpress\API\Data\Transformers\BoolToStringTransformer;
use Squarebit\InvoiceXpress\Enums\GuideStatusEnum;

class GuideListFilter extends QueryFilter
{
    public function __construct(
        public Optional|string $text,

        /** @var Optional|array<\Squarebit\InvoiceXpress\Enums\GuideTypeEnum> */
        public Optional|array $type,

        /** @var Optional|array<GuideStatusEnum> */
        public Optional|array $status,

        public Optional|DateIntervalFilter $loadedAt,

        #[WithTransformer(BoolToStringTransformer::class)]
        public Optional|bool $nonArchived,

        #[WithTransformer(BoolToStringTransformer::class)]
        public Optional|bool $archived,

        public Optional|int $page,

        public Optional|int $perPage,
    ) {
    }
}

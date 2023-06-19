<?php

namespace Squarebit\InvoiceXpress\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Squarebit\InvoiceXpress\Models\IxAbstractEstimate;

class EstimateTypeScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        if ($model instanceof IxAbstractEstimate) {
            $builder->where('type', $model->getEstimateType()->value);
        }
    }
}

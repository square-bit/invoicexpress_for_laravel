<?php

namespace Squarebit\InvoiceXpress\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Squarebit\InvoiceXpress\Models\IxAbstractGuide;

class GuideTypeScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        if ($model instanceof IxAbstractGuide) {
            $builder->where('type', $model->getGuideType()->value);
        }
    }
}

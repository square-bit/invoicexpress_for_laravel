<?php

namespace Squarebit\InvoiceXpress\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Squarebit\InvoiceXpress\Models\IxAbstractInvoice;

class InvoiceTypeScope implements Scope
{
    /**
     * @param  Builder<IxAbstractInvoice>  $builder
     */
    public function apply(Builder $builder, Model $model): void
    {
        if ($model instanceof IxAbstractInvoice) {
            $builder->where('type', $model->getInvoiceType()->value);
        }
    }
}

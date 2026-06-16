<?php

namespace Squarebit\InvoiceXpress\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Squarebit\InvoiceXpress\Models\IxAbstractInvoice;

/**
 * @implements Scope<IxAbstractInvoice>
 */
class InvoiceTypeScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        $builder->where('type', $model->getInvoiceType()->value);
    }
}

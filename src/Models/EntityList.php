<?php

namespace Squarebit\InvoiceXpress\Models;

use Illuminate\Support\Collection;

class EntityList
{
    protected IXModel $model;
    protected Collection $items;
    protected array $pagination;
    protected int $currentPage;
    protected int $perPage;
    protected int $totalEntries;
    protected int $totalPages;

    public function __construct(IXModel $model, Collection $list, array $pagination)
    {
        $this->model = $model;
        $this->pagination = $pagination;
        $this->currentPage = $pagination['current_page'];
        $this->perPage = $pagination['per_page'];
        $this->totalEntries = $pagination['total_entries'];
        $this->totalPages = $pagination['total_pages'];

        $this->items = $list->map(fn ($data) => $model->setAttributes($data));
    }

    public function items(): Collection
    {
        return $this->items;
    }

    public function nextPage(): ?static
    {
        return $this->currentPage === $this->totalPages
            ? null
            : $this->model->list($this->currentPage++, $this->perPage);
    }

    public function reloadPage(): ?static
    {
        return $this->model->list($this->currentPage, $this->perPage);
    }

    public function previousPage(): ?static
    {
        return $this->currentPage === 1
            ? null
            : $this->model->list($this->currentPage--, $this->perPage);
    }
}

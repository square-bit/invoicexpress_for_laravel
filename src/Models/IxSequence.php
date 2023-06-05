<?php

namespace Squarebit\InvoiceXpress\Models;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\SequenceData;
use Squarebit\InvoiceXpress\API\Endpoints\SequencesEndpoint;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;

class IxSequence extends IxModel
{
    protected EntityTypeEnum $entityType = EntityTypeEnum::Sequence;

    protected string $dataClass = SequenceData::class;

    protected $table = 'ix_sequences';

    protected $casts = [
        'default_sequence' => 'bool',
    ];

    public function getEndpoint(): SequencesEndpoint
    {
        return new SequencesEndpoint();
    }

    public function setCurrent(): bool
    {
        try {
            $this->getEndpoint()->setCurrent($this->getKey());

            return true;
        } catch (RequestException) {
            return false;
        }
    }
}

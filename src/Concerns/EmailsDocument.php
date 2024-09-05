<?php

namespace Squarebit\InvoiceXpress\Concerns;

use Squarebit\InvoiceXpress\API\Data\EmailClientData;
use Squarebit\InvoiceXpress\API\Data\EmailData;
use Squarebit\InvoiceXpress\Models\IxClient;

trait EmailsDocument
{
    public function email(
        ?IxClient $client = null,
        ?string $subject = null,
        ?string $body = null,
        ?string $cc = null,
        ?string $bcc = null,
        bool $includeLogo = true
    ): static {

        $clientData = EmailClientData::fromEmail($client->email ?? $this->client->email);

        $this->getEndpoint()->sendByEmail(
            $this->getEntityType(),
            $this->id,
            EmailData::to(
                client: $clientData,
                subject: $subject,
                body: $body,
                cc: $cc,
                bcc: $bcc,
                logo: $includeLogo
            )
        );

        return $this;
    }
}

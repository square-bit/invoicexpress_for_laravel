<?php

namespace Squarebit\InvoiceXpress\Concerns;

use Exception;
use Squarebit\InvoiceXpress\API\Data\EmailClientData;
use Squarebit\InvoiceXpress\API\Data\EmailData;
use Squarebit\InvoiceXpress\Models\IxClient;

trait EmailsDocument
{
    public function email(
        IxClient $client,
        ?string $subject = null,
        ?string $body = null,
        ?string $cc = null,
        ?string $bcc = null,
        bool $includeLogo = true
    ): static {

        if ($client->email === null) {
            throw new Exception('Client email is not set.');
        }

        $emailClientData = EmailClientData::fromEmail($client->email);

        $this->getEndpoint()->sendByEmail(
            $this->getEntityType(),
            $this->id,
            EmailData::to(
                client: $emailClientData,
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

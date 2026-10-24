<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Request;

use Estratos\DomainApiInterface\Exception\RequestValidationException;

/**
 * Request to delete a DNS record from a domain.
 */
final readonly class DeleteDnsRecordRequest
{
    /**
     * @throws RequestValidationException when the domain or record ID is empty
     */
    public function __construct(
        public string $domain,
        public string $recordId,
    ) {
        if (empty($domain)) {
            throw new RequestValidationException('Domain cannot be empty');
        }

        if (empty($recordId)) {
            throw new RequestValidationException('Record ID cannot be empty');
        }
    }
}

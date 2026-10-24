<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Request;

use Estratos\DomainApiInterface\Exception\RequestValidationException;

/**
 * Request to renew an existing domain registration.
 */
final readonly class RenewDomainRequest
{
    /**
     * @throws RequestValidationException when the domain or term is invalid
     */
    public function __construct(
        public string $domain,
        public int $years,
    ) {
        if ($years < 1 || $years > 10) {
            throw new RequestValidationException('Years must be between 1 and 10');
        }

        if (empty($domain)) {
            throw new RequestValidationException('Domain cannot be empty');
        }
    }
}

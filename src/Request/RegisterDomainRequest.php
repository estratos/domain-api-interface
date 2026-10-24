<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Request;

use Estratos\DomainApiInterface\Exception\RequestValidationException;

/**
 * Request to register a new domain for one or more years.
 */
final readonly class RegisterDomainRequest
{
    /**
     * @throws RequestValidationException when the domain, contact or term is invalid
     */
    public function __construct(
        public string $domain,
        public int $years,
        public string $contactId,
        public bool $private = false,
        public bool $autoRenew = false,
        public ?string $nameserver1 = null,
        public ?string $nameserver2 = null,
        public ?string $nameserver3 = null,
        public ?string $nameserver4 = null,
    ) {
        if ($years < 1 || $years > 10) {
            throw new RequestValidationException('Years must be between 1 and 10');
        }

        if (empty($domain)) {
            throw new RequestValidationException('Domain cannot be empty');
        }

        if (empty($contactId)) {
            throw new RequestValidationException('Contact ID cannot be empty');
        }
    }
}

<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Request;

use Estratos\DomainApiInterface\Exception\RequestValidationException;

/**
 * Request to transfer a domain into this registrar.
 */
final readonly class TransferDomainRequest
{
    /**
     * @throws RequestValidationException when the domain, authorization code or term is invalid
     */
    public function __construct(
        public string $domain,
        public string $authorizationCode,
        public int $years = 1,
        public bool $private = false,
        public bool $autoRenew = false,
    ) {
        if (empty($domain)) {
            throw new RequestValidationException('Domain cannot be empty');
        }

        if (empty($authorizationCode)) {
            throw new RequestValidationException('Authorization code cannot be empty');
        }

        if ($years < 1 || $years > 10) {
            throw new RequestValidationException('Years must be between 1 and 10');
        }
    }
}

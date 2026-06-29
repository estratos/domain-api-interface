<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Request;

final readonly class RegisterDomainRequest
{
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
            throw new \InvalidArgumentException('Years must be between 1 and 10');
        }

        if (empty($domain)) {
            throw new \InvalidArgumentException('Domain cannot be empty');
        }

        if (empty($contactId)) {
            throw new \InvalidArgumentException('Contact ID cannot be empty');
        }
    }
}

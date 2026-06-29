<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Request;

final readonly class RenewDomainRequest
{
    public function __construct(
        public string $domain,
        public int $years,
    ) {
        if ($years < 1 || $years > 10) {
            throw new \InvalidArgumentException('Years must be between 1 and 10');
        }

        if (empty($domain)) {
            throw new \InvalidArgumentException('Domain cannot be empty');
        }
    }
}

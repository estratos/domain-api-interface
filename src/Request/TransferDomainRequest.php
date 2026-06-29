<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Request;

final readonly class TransferDomainRequest
{
    public function __construct(
        public string $domain,
        public string $authorizationCode,
        public int $years = 1,
        public bool $private = false,
        public bool $autoRenew = false,
    ) {
        if (empty($domain)) {
            throw new \InvalidArgumentException('Domain cannot be empty');
        }

        if (empty($authorizationCode)) {
            throw new \InvalidArgumentException('Authorization code cannot be empty');
        }

        if ($years < 1 || $years > 10) {
            throw new \InvalidArgumentException('Years must be between 1 and 10');
        }
    }
}

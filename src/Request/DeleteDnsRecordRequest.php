<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Request;

final readonly class DeleteDnsRecordRequest
{
    public function __construct(
        public string $domain,
        public string $recordId,
    ) {
        if (empty($domain)) {
            throw new \InvalidArgumentException('Domain cannot be empty');
        }

        if (empty($recordId)) {
            throw new \InvalidArgumentException('Record ID cannot be empty');
        }
    }
}

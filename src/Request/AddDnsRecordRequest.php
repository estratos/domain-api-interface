<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Request;

use Estratos\DomainApiInterface\Enum\RecordType;

final readonly class AddDnsRecordRequest
{
    public function __construct(
        public string $domain,
        public string $host,
        public RecordType $type,
        public string $value,
        public int $ttl = 3600,
        public ?int $priority = null,
        public ?int $port = null,
        public ?int $weight = null,
    ) {
        if (empty($domain)) {
            throw new \InvalidArgumentException('Domain cannot be empty');
        }

        if (empty($host)) {
            throw new \InvalidArgumentException('Host cannot be empty');
        }

        if (empty($value)) {
            throw new \InvalidArgumentException('Value cannot be empty');
        }

        if ($ttl < 60 || $ttl > 86400) {
            throw new \InvalidArgumentException('TTL must be between 60 and 86400 seconds');
        }

        if ($type->requiresPriority() && $priority === null) {
            throw new \InvalidArgumentException('Priority is required for ' . $type->value . ' records');
        }

        if ($type === RecordType::SRV) {
            if ($port === null || $weight === null) {
                throw new \InvalidArgumentException('Port and weight are required for SRV records');
            }
        }
    }
}

<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Request;

use Estratos\DomainApiInterface\Enum\RecordType;
use Estratos\DomainApiInterface\Exception\RequestValidationException;

/**
 * Request to add a DNS record to a domain.
 */
final readonly class AddDnsRecordRequest
{
    /**
     * @throws RequestValidationException when the record data is invalid
     */
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
            throw new RequestValidationException('Domain cannot be empty');
        }

        if (empty($host)) {
            throw new RequestValidationException('Host cannot be empty');
        }

        if (empty($value)) {
            throw new RequestValidationException('Value cannot be empty');
        }

        if ($ttl < 60 || $ttl > 86400) {
            throw new RequestValidationException('TTL must be between 60 and 86400 seconds');
        }

        if ($type->requiresPriority() && null === $priority) {
            throw new RequestValidationException('Priority is required for ' . $type->value . ' records');
        }

        if (RecordType::SRV === $type && (null === $port || null === $weight)) {
            throw new RequestValidationException('Port and weight are required for SRV records');
        }
    }
}

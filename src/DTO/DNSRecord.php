<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\DTO;

use Estratos\DomainApiInterface\Enum\RecordType;

final readonly class DNSRecord
{
    public function __construct(
        public string $id,
        public string $host,
        public RecordType $type,
        public string $value,
        public int $ttl,
        public ?string $domain = null,
        public ?int $priority = null,
        public ?int $port = null,
        public ?int $weight = null,
    ) {
    }

    public function isA(): bool
    {
        return $this->type === RecordType::A;
    }

    public function isAAAA(): bool
    {
        return $this->type === RecordType::AAAA;
    }

    public function isCNAME(): bool
    {
        return $this->type === RecordType::CNAME;
    }

    public function isMX(): bool
    {
        return $this->type === RecordType::MX;
    }

    public function hasPriority(): bool
    {
        return $this->priority !== null && $this->type === RecordType::MX;
    }
}

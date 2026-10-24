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
        return RecordType::A === $this->type;
    }

    public function isAAAA(): bool
    {
        return RecordType::AAAA === $this->type;
    }

    public function isCNAME(): bool
    {
        return RecordType::CNAME === $this->type;
    }

    public function isMX(): bool
    {
        return RecordType::MX === $this->type;
    }

    public function hasPriority(): bool
    {
        return null !== $this->priority && RecordType::MX === $this->type;
    }
}

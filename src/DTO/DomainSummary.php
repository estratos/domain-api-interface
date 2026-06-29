<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\DTO;

use DateTimeImmutable;

final readonly class DomainSummary
{
    public function __construct(
        public string $domain,
        public string $status,
        public DateTimeImmutable $createdAt,
        public DateTimeImmutable $expiresAt,
        public bool $isLocked,
        public bool $isPrivacyEnabled,
    ) {
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isExpired(): bool
    {
        return $this->expiresAt < new DateTimeImmutable();
    }
}

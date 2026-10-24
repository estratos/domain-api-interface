<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\DTO;

/**
 * Brief information about a domain, used by list operations.
 */
final readonly class DomainSummary
{
    public const STATUS_ACTIVE = 'active';

    public function __construct(
        public string $domain,
        public string $status,
        public \DateTimeImmutable $createdAt,
        public \DateTimeImmutable $expiresAt,
        public bool $isLocked,
        public bool $isPrivacyEnabled,
    ) {
    }

    public function isActive(): bool
    {
        return self::STATUS_ACTIVE === strtolower(trim($this->status));
    }

    public function isExpired(): bool
    {
        return $this->expiresAt < new \DateTimeImmutable();
    }
}

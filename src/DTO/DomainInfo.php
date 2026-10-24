<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\DTO;

/**
 * Detailed information about a registered domain.
 */
final readonly class DomainInfo
{
    public const STATUS_ACTIVE = 'active';

    /**
     * @param string[] $nameServers name servers currently assigned to the domain
     */
    public function __construct(
        public string $domain,
        public string $status,
        public \DateTimeImmutable $createdAt,
        public \DateTimeImmutable $expiresAt,
        public \DateTimeImmutable $updatedAt,
        public bool $isLocked,
        public bool $isPrivacyEnabled,
        public bool $isAutoRenewEnabled,
        public array $nameServers,
        public ?string $registrantContactId = null,
        public ?string $adminContactId = null,
        public ?string $techContactId = null,
        public ?string $billingContactId = null,
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

    /**
     * Number of days until the domain expires; negative once it has expired.
     */
    public function daysUntilExpiration(): int
    {
        return (int) (new \DateTimeImmutable())->diff($this->expiresAt)->format('%r%a');
    }

    public function isLocked(): bool
    {
        return $this->isLocked;
    }

    public function isPrivacyEnabled(): bool
    {
        return $this->isPrivacyEnabled;
    }

    public function hasCustomNameServers(): bool
    {
        return [] !== $this->nameServers;
    }
}

<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\DTO;

use DateTimeImmutable;

final readonly class DomainInfo
{
    public function __construct(
        public string $domain,
        public string $status,
        public DateTimeImmutable $createdAt,
        public DateTimeImmutable $expiresAt,
        public DateTimeImmutable $updatedAt,
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
        return $this->status === 'active';
    }

    public function isExpired(): bool
    {
        return $this->expiresAt < new DateTimeImmutable();
    }

    public function daysUntilExpiration(): int
    {
        $now = new DateTimeImmutable();
        $interval = $now->diff($this->expiresAt);
        return (int) $interval->days;
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
        return !empty($this->nameServers);
    }
}

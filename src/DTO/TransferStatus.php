<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\DTO;

use DateTimeImmutable;

final readonly class TransferStatus
{
    public function __construct(
        public string $domain,
        public string $status,
        public DateTimeImmutable $initiatedAt,
        public ?DateTimeImmutable $completedAt = null,
        public ?DateTimeImmutable $expiresAt = null,
        public ?string $message = null,
    ) {
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isFailed(): bool
    {
        return $this->status === 'failed';
    }

    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }
}

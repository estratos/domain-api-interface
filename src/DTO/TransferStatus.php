<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\DTO;

/**
 * Status of a domain transfer.
 *
 * Providers are expected to map their registrar-specific status values to the
 * canonical values exposed as constants on this class.
 */
final readonly class TransferStatus
{
    public const STATUS_PENDING = 'pending';

    public const STATUS_COMPLETED = 'completed';

    public const STATUS_FAILED = 'failed';

    public const STATUS_CANCELLED = 'cancelled';

    /**
     * @param string $status one of the STATUS_* constants
     */
    public function __construct(
        public string $domain,
        public string $status,
        public \DateTimeImmutable $initiatedAt,
        public ?\DateTimeImmutable $completedAt = null,
        public ?\DateTimeImmutable $expiresAt = null,
        public ?string $message = null,
    ) {
    }

    public function isPending(): bool
    {
        return self::STATUS_PENDING === $this->normalizedStatus();
    }

    public function isCompleted(): bool
    {
        return self::STATUS_COMPLETED === $this->normalizedStatus();
    }

    public function isFailed(): bool
    {
        return self::STATUS_FAILED === $this->normalizedStatus();
    }

    public function isCancelled(): bool
    {
        return self::STATUS_CANCELLED === $this->normalizedStatus();
    }

    private function normalizedStatus(): string
    {
        return strtolower(trim($this->status));
    }
}

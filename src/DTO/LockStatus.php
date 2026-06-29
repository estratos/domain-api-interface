<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\DTO;

final readonly class LockStatus
{
    public function __construct(
        public string $domain,
        public bool $locked,
        public ?string $status = null,
        public ?string $message = null,
    ) {
    }

    public function isLocked(): bool
    {
        return $this->locked;
    }

    public function isUnlocked(): bool
    {
        return !$this->locked;
    }
}

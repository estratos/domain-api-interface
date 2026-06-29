<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\DTO;

final readonly class PrivacyStatus
{
    public function __construct(
        public string $domain,
        public bool $enabled,
        public ?string $status = null,
        public ?string $message = null,
    ) {
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function isDisabled(): bool
    {
        return !$this->enabled;
    }
}

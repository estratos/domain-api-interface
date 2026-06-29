<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\DTO;

final readonly class DomainAvailability
{
    public function __construct(
        public string $domain,
        public bool $available,
        public ?string $reason = null,
        public ?string $suggestedAlternative = null,
    ) {
    }

    public function isAvailable(): bool
    {
        return $this->available;
    }

    public function isUnavailable(): bool
    {
        return !$this->available;
    }
}

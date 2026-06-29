<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\DTO;

final readonly class AccountBalance
{
    public function __construct(
        public float $balance,
        public string $currency,
        public float $available,
        public float $reserved,
        public ?float $creditLimit = null,
    ) {
    }

    public function isPositive(): bool
    {
        return $this->balance > 0;
    }

    public function isNegative(): bool
    {
        return $this->balance < 0;
    }

    public function hasSufficientFunds(float $amount): bool
    {
        return $this->available >= $amount;
    }
}

<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\DTO;

final readonly class PriceList
{
    public function __construct(
        public array $prices,
        public string $currency,
    ) {
    }

    public function getPrice(string $tld): ?float
    {
        return $this->prices[$tld] ?? null;
    }

    public function getPricesByCategory(string $category): array
    {
        return array_filter(
            $this->prices,
            fn($price, $tld) => str_contains($tld, $category),
            ARRAY_FILTER_USE_BOTH
        );
    }
}

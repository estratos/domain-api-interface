<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\DTO;

/**
 * Pricing information, keyed by TLD.
 */
final readonly class PriceList
{
    /**
     * @param array<string, float> $prices map of TLD (e.g. ".com") to price
     */
    public function __construct(
        public array $prices,
        public string $currency,
    ) {
    }

    public function getPrice(string $tld): ?float
    {
        return $this->prices[$tld] ?? null;
    }

    /**
     * @return array<string, float>
     */
    public function getPricesByCategory(string $category): array
    {
        return array_filter(
            $this->prices,
            static fn (float $price, string $tld): bool => str_contains($tld, $category),
            \ARRAY_FILTER_USE_BOTH,
        );
    }
}

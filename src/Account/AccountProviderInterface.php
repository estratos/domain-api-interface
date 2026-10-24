<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Account;

use Estratos\DomainApiInterface\DTO\AccountBalance;
use Estratos\DomainApiInterface\DTO\PriceList;
use Estratos\DomainApiInterface\Exception\ProviderException;

/**
 * Account balance and pricing operations.
 */
interface AccountProviderInterface
{
    /**
     * Get the current account balance.
     *
     * @throws ProviderException when the balance cannot be retrieved
     */
    public function getBalance(): AccountBalance;

    /**
     * Get pricing information, optionally filtered by domain type.
     *
     * @throws ProviderException when the prices cannot be retrieved
     */
    public function getPrices(?string $domainType = null): PriceList;
}

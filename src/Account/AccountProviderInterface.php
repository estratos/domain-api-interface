<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Account;

use Estratos\DomainApiInterface\DTO\AccountBalance;
use Estratos\DomainApiInterface\DTO\PriceList;

interface AccountProviderInterface
{
    /**
     * Get the current account balance.
     */
    public function getBalance(): AccountBalance;
    
    /**
     * Get pricing information.
     */
    public function getPrices(?string $domainType = null): PriceList;
}

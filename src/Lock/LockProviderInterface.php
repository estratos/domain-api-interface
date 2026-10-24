<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Lock;

use Estratos\DomainApiInterface\DTO\LockStatus;
use Estratos\DomainApiInterface\Exception\ProviderException;

/**
 * Domain locking operations.
 */
interface LockProviderInterface
{
    /**
     * Lock a domain to prevent unauthorized transfers.
     *
     * @throws ProviderException when the domain cannot be locked
     */
    public function lock(string $domain): LockStatus;

    /**
     * Unlock a domain to allow transfers.
     *
     * @throws ProviderException when the domain cannot be unlocked
     */
    public function unlock(string $domain): LockStatus;
}

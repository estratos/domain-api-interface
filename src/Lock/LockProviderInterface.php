<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Lock;

use Estratos\DomainApiInterface\DTO\LockStatus;

interface LockProviderInterface
{
    /**
     * Lock a domain to prevent unauthorized transfers.
     */
    public function lock(string $domain): LockStatus;
    
    /**
     * Unlock a domain to allow transfers.
     */
    public function unlock(string $domain): LockStatus;
}

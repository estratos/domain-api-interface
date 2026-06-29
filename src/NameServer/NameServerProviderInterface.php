<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\NameServer;

interface NameServerProviderInterface
{
    /**
     * Change the name servers for a domain.
     */
    public function changeNameServers(string $domain, array $nameServers): bool;
}

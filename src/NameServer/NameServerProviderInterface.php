<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\NameServer;

use Estratos\DomainApiInterface\Exception\ProviderException;

/**
 * Name server management operations.
 */
interface NameServerProviderInterface
{
    /**
     * Change the name servers for a domain.
     *
     * @param string[] $nameServers the complete set of name servers to apply
     *
     * @throws ProviderException when the change fails
     * @return bool true when the name servers were changed
     */
    public function changeNameServers(string $domain, array $nameServers): bool;
}

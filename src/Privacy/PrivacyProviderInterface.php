<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Privacy;

use Estratos\DomainApiInterface\DTO\PrivacyStatus;
use Estratos\DomainApiInterface\Exception\ProviderException;

/**
 * WHOIS privacy protection operations.
 */
interface PrivacyProviderInterface
{
    /**
     * Enable WHOIS privacy protection for a domain.
     *
     * @throws ProviderException when privacy cannot be enabled
     */
    public function addPrivacy(string $domain, string $contactId): PrivacyStatus;

    /**
     * Disable WHOIS privacy protection for a domain.
     *
     * @throws ProviderException when privacy cannot be disabled
     */
    public function removePrivacy(string $domain): PrivacyStatus;
}

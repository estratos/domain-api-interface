<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Privacy;

use Estratos\DomainApiInterface\DTO\PrivacyStatus;

interface PrivacyProviderInterface
{
    /**
     * Enable WHOIS privacy protection for a domain.
     */
    public function addPrivacy(string $domain, string $contactId): PrivacyStatus;
    
    /**
     * Disable WHOIS privacy protection for a domain.
     */
    public function removePrivacy(string $domain): PrivacyStatus;
}

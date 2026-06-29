<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\DNS;

use Estratos\DomainApiInterface\DTO\DNSRecord;
use Estratos\DomainApiInterface\Request\AddDnsRecordRequest;
use Estratos\DomainApiInterface\Request\DeleteDnsRecordRequest;
use Estratos\DomainApiInterface\Request\UpdateDnsRecordRequest;

interface DNSProviderInterface
{
    /**
     * List DNS records for a domain.
     * @return DNSRecord[]
     */
    public function listRecords(string $domain, ?string $type = null): array;
    
    /**
     * Add a new DNS record.
     */
    public function addRecord(AddDnsRecordRequest $request): DNSRecord;
    
    /**
     * Update an existing DNS record.
     */
    public function updateRecord(UpdateDnsRecordRequest $request): DNSRecord;
    
    /**
     * Delete a DNS record.
     */
    public function deleteRecord(DeleteDnsRecordRequest $request): bool;
}

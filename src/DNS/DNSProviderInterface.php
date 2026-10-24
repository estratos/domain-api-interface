<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\DNS;

use Estratos\DomainApiInterface\DTO\DNSRecord;
use Estratos\DomainApiInterface\Exception\ProviderException;
use Estratos\DomainApiInterface\Request\AddDnsRecordRequest;
use Estratos\DomainApiInterface\Request\DeleteDnsRecordRequest;
use Estratos\DomainApiInterface\Request\UpdateDnsRecordRequest;

/**
 * DNS record management for zones hosted by the registrar.
 */
interface DNSProviderInterface
{
    /**
     * List DNS records for a domain, optionally filtered by record type.
     *
     * @throws ProviderException when the records cannot be retrieved
     * @return DNSRecord[]
     */
    public function listRecords(string $domain, ?string $type = null): array;

    /**
     * Add a new DNS record.
     *
     * @throws ProviderException when the record cannot be created
     */
    public function addRecord(AddDnsRecordRequest $request): DNSRecord;

    /**
     * Update an existing DNS record.
     *
     * @throws ProviderException when the record cannot be updated
     */
    public function updateRecord(UpdateDnsRecordRequest $request): DNSRecord;

    /**
     * Delete a DNS record.
     *
     * @throws ProviderException when the record cannot be deleted
     * @return bool true when the record was deleted
     */
    public function deleteRecord(DeleteDnsRecordRequest $request): bool;
}

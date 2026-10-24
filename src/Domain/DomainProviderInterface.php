<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Domain;

use Estratos\DomainApiInterface\DTO\DomainAvailability;
use Estratos\DomainApiInterface\DTO\DomainInfo;
use Estratos\DomainApiInterface\DTO\DomainSummary;
use Estratos\DomainApiInterface\DTO\RegistrationResult;
use Estratos\DomainApiInterface\DTO\TransferStatus;
use Estratos\DomainApiInterface\Exception\ProviderException;
use Estratos\DomainApiInterface\Request\RegisterDomainRequest;
use Estratos\DomainApiInterface\Request\RenewDomainRequest;
use Estratos\DomainApiInterface\Request\TransferDomainRequest;

/**
 * Domain registration and lifecycle operations.
 */
interface DomainProviderInterface
{
    /**
     * Check if a domain is available for registration.
     *
     * @throws ProviderException when the registrar cannot answer the query
     */
    public function checkAvailability(string $domain): DomainAvailability;

    /**
     * Register a new domain.
     *
     * @throws ProviderException when the registration fails
     */
    public function register(RegisterDomainRequest $request): RegistrationResult;

    /**
     * Renew an existing domain registration.
     *
     * @throws ProviderException when the renewal fails
     */
    public function renew(RenewDomainRequest $request): RegistrationResult;

    /**
     * Transfer a domain to this registrar.
     *
     * @throws ProviderException when the transfer cannot be started
     */
    public function transfer(TransferDomainRequest $request): RegistrationResult;

    /**
     * Get the status of a domain transfer.
     *
     * @throws ProviderException when the status cannot be retrieved
     */
    public function getTransferStatus(string $domain): TransferStatus;

    /**
     * Get detailed information about a domain.
     *
     * @throws ProviderException when the domain is unknown or the query fails
     */
    public function getInfo(string $domain): DomainInfo;

    /**
     * List all domains in the account.
     *
     * @throws ProviderException when the listing fails
     * @return DomainSummary[]
     */
    public function list(): array;

    /**
     * List domains by expiration date, soonest first.
     *
     * @throws ProviderException when the listing fails
     * @return DomainSummary[]
     */
    public function listByExpirationDate(): array;
}

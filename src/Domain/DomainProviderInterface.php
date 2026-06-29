<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Domain;

use Estratos\DomainApiInterface\DTO\DomainAvailability;
use Estratos\DomainApiInterface\DTO\DomainInfo;
use Estratos\DomainApiInterface\DTO\DomainSummary;
use Estratos\DomainApiInterface\DTO\RegistrationResult;
use Estratos\DomainApiInterface\DTO\TransferStatus;
use Estratos\DomainApiInterface\Request\RegisterDomainRequest;
use Estratos\DomainApiInterface\Request\RenewDomainRequest;
use Estratos\DomainApiInterface\Request\TransferDomainRequest;

interface DomainProviderInterface
{
    /**
     * Check if a domain is available for registration.
     */
    public function checkAvailability(string $domain): DomainAvailability;
    
    /**
     * Register a new domain.
     */
    public function register(RegisterDomainRequest $request): RegistrationResult;
    
    /**
     * Renew an existing domain registration.
     */
    public function renew(RenewDomainRequest $request): RegistrationResult;
    
    /**
     * Transfer a domain to this registrar.
     */
    public function transfer(TransferDomainRequest $request): RegistrationResult;
    
    /**
     * Get the status of a domain transfer.
     */
    public function getTransferStatus(string $domain): TransferStatus;
    
    /**
     * Get detailed information about a domain.
     */
    public function getInfo(string $domain): DomainInfo;
    
    /**
     * List all domains in the account.
     * @return DomainSummary[]
     */
    public function list(): array;
    
    /**
     * List domains by expiration date.
     * @return DomainSummary[]
     */
    public function listByExpirationDate(): array;
}

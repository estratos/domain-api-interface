# Domain API Interface Bundle

[![PHP Version](https://img.shields.io/badge/php-%3E%3D8.3-8892BF.svg)](https://php.net/)
[![Symfony Version](https://img.shields.io/badge/symfony-%3E%3D7.0-333333.svg)](https://symfony.com/)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)

## Overview

This bundle provides a set of common contracts (interfaces) for domain registrar integration. It defines the standard API that all domain provider implementations must follow.

## Purpose

The Domain API Interface Bundle serves as the foundation for a pluggable domain registrar architecture. By coding against these contracts, applications can seamlessly switch between different domain registrars without changing business logic.

## Architecture

┌─────────────────────────────────────────────┐
│ Domain API Interface Bundle │
│ (Contracts & DTOs - This Bundle) │
└────────────────┬────────────────────────────┘
│ Implements
┌────────────┼────────────┬───────────────┐
│ │ │ │
┌───▼────┐ ┌───▼────┐ ┌───▼────┐ ┌─────▼─────┐
│NameSilo │ │GoDaddy │ │Porkbun │ │ Cloudflare │
│ Bundle │ │ Bundle │ │ Bundle │ │ Registry │
└─────────┘ └────────┘ └────────┘ └───────────┘



## Features

- ✅ Pure interface definitions - no implementation
- ✅ Immutable DTOs (readonly classes)
- ✅ Strong typing with PHP 8.3+
- ✅ Enum support for type-safe values
- ✅ Request objects for type-safe API calls
- ✅ SOLID principles
- ✅ PSR-4 autoloading
- ✅ PSR-12 coding standards

## Installation

```bash
composer require estratos/domain-api-interface


Components
Contracts (Interfaces)
DomainProviderInterface - Domain registration and management

DNSProviderInterface - DNS record management

ContactProviderInterface - Contact management

AccountProviderInterface - Account balance and pricing

PrivacyProviderInterface - WHOIS privacy protection

LockProviderInterface - Domain locking/unlocking

NameServerProviderInterface - Name server management

Data Transfer Objects (DTOs)
All DTOs are immutable readonly classes:

DomainAvailability - Domain availability check result

DomainInfo - Detailed domain information

DomainSummary - Brief domain information

RegistrationResult - Registration operation result

TransferStatus - Domain transfer status

DNSRecord - DNS record information

Contact - Contact information

AccountBalance - Account balance information

PriceList - Pricing information

PrivacyStatus - Privacy protection status

LockStatus - Domain lock status

Request Objects
Type-safe request objects for API calls:

RegisterDomainRequest - Domain registration request

RenewDomainRequest - Domain renewal request

TransferDomainRequest - Domain transfer request

AddDnsRecordRequest - Add DNS record request

UpdateDnsRecordRequest - Update DNS record request

DeleteDnsRecordRequest - Delete DNS record request

AddContactRequest - Add contact request

UpdateContactRequest - Update contact request

Enums
RecordType - DNS record types (A, AAAA, CNAME, MX, TXT, etc.)

Usage Example
Implementing a Provider
php
<?php

declare(strict_types=1);

namespace YourProvider\Service;

use Estratos\DomainApiInterface\Domain\DomainProviderInterface;
use Estratos\DomainApiInterface\DTO\DomainAvailability;
use Estratos\DomainApiInterface\DTO\RegistrationResult;
use Estratos\DomainApiInterface\Request\RegisterDomainRequest;

final class YourDomainProvider implements DomainProviderInterface
{
    public function checkAvailability(string $domain): DomainAvailability
    {
        // Implementation
    }
    
    public function register(RegisterDomainRequest $request): RegistrationResult
    {
        // Implementation
    }
    
    // ... implement all other methods
}
Using a Provider in an Application
php
<?php

declare(strict_types=1);

use Estratos\DomainApiInterface\Domain\DomainProviderInterface;
use Estratos\DomainApiInterface\Request\RegisterDomainRequest;

final class DomainRegistrationService
{
    public function __construct(
        private readonly DomainProviderInterface $domainProvider
    ) {
    }
    
    public function registerDomain(string $domain, string $contactId): void
    {
        $availability = $this->domainProvider->checkAvailability($domain);
        
        if (!$availability->isAvailable()) {
            throw new \RuntimeException('Domain is not available');
        }
        
        $request = new RegisterDomainRequest(
            domain: $domain,
            years: 2,
            contactId: $contactId,
            private: true,
            autoRenew: true
        );
        
        $result = $this->domainProvider->register($request);
        
        if (!$result->isSuccess()) {
            throw new \RuntimeException('Registration failed: ' . $result->errorMessage);
        }
    }
}
Available Providers
Providers that implement these contracts:

estratos/namesilo-bundle - NameSilo integration

More providers coming soon

Testing
bash
composer test
PHPStan Analysis
bash
composer phpstan
Code Style
bash
composer php-cs-fixer
composer php-cs-fixer-fix
Contributing
Fork the repository

Create a feature branch

Make your changes

Run tests and style checks

Submit a pull request

License
MIT License. See the LICENSE file for details.

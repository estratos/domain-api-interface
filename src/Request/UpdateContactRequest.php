<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Request;

final readonly class UpdateContactRequest
{
    public function __construct(
        public string $contactId,
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $phone,
        public string $organization,
        public string $address1,
        public string $city,
        public string $state,
        public string $postalCode,
        public string $country,
        public ?string $address2 = null,
        public ?string $fax = null,
        public bool $isDefault = false,
    ) {
        if (empty($contactId)) {
            throw new \InvalidArgumentException('Contact ID cannot be empty');
        }

        if (empty($firstName)) {
            throw new \InvalidArgumentException('First name cannot be empty');
        }

        if (empty($lastName)) {
            throw new \InvalidArgumentException('Last name cannot be empty');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Invalid email format');
        }

        if (empty($phone)) {
            throw new \InvalidArgumentException('Phone cannot be empty');
        }

        if (empty($address1)) {
            throw new \InvalidArgumentException('Address cannot be empty');
        }

        if (empty($city)) {
            throw new \InvalidArgumentException('City cannot be empty');
        }

        if (empty($state)) {
            throw new \InvalidArgumentException('State cannot be empty');
        }

        if (empty($postalCode)) {
            throw new \InvalidArgumentException('Postal code cannot be empty');
        }

        if (empty($country)) {
            throw new \InvalidArgumentException('Country cannot be empty');
        }
    }
}

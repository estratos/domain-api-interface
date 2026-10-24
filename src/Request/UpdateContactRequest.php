<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Request;

use Estratos\DomainApiInterface\Exception\RequestValidationException;

/**
 * Request to update an existing contact.
 */
final readonly class UpdateContactRequest
{
    /**
     * @throws RequestValidationException when a required field is empty or the email is invalid
     */
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
            throw new RequestValidationException('Contact ID cannot be empty');
        }

        if (empty($firstName)) {
            throw new RequestValidationException('First name cannot be empty');
        }

        if (empty($lastName)) {
            throw new RequestValidationException('Last name cannot be empty');
        }

        if (!filter_var($email, \FILTER_VALIDATE_EMAIL)) {
            throw new RequestValidationException('Invalid email format');
        }

        if (empty($phone)) {
            throw new RequestValidationException('Phone cannot be empty');
        }

        if (empty($address1)) {
            throw new RequestValidationException('Address cannot be empty');
        }

        if (empty($city)) {
            throw new RequestValidationException('City cannot be empty');
        }

        if (empty($state)) {
            throw new RequestValidationException('State cannot be empty');
        }

        if (empty($postalCode)) {
            throw new RequestValidationException('Postal code cannot be empty');
        }

        if (empty($country)) {
            throw new RequestValidationException('Country cannot be empty');
        }
    }
}

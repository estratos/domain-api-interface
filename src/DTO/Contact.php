<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\DTO;

final readonly class Contact
{
    public function __construct(
        public string $id,
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
        public ?bool $isDefault = null,
    ) {
    }

    public function getFullName(): string
    {
        return trim($this->firstName . ' ' . $this->lastName);
    }

    public function getFullAddress(): string
    {
        $address = $this->address1;
        if ($this->address2 !== null) {
            $address .= ', ' . $this->address2;
        }
        return $address . ', ' . $this->city . ', ' . $this->state . ' ' . $this->postalCode . ', ' . $this->country;
    }
}

<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Tests\DTO;

use Estratos\DomainApiInterface\DTO\Contact;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @small
 */
#[CoversClass(Contact::class)]
final class ContactTest extends TestCase
{
    public function testBuildsFullName(): void
    {
        $this->assertSame('Jane Doe', $this->createContact()->getFullName());
    }

    public function testBuildsFullAddressWithSecondLine(): void
    {
        $this->assertSame(
            '1 Main St, Apt 2, Springfield, IL 62701, US',
            $this->createContact()->getFullAddress(),
        );
    }

    public function testOmitsMissingSecondLine(): void
    {
        $contact = new Contact(
            id: 'c-1',
            firstName: 'Jane',
            lastName: 'Doe',
            email: 'jane@example.com',
            phone: '+1 555 0100',
            organization: 'Acme',
            address1: '1 Main St',
            city: 'Springfield',
            state: 'IL',
            postalCode: '62701',
            country: 'US',
        );

        $this->assertSame('1 Main St, Springfield, IL 62701, US', $contact->getFullAddress());
        $this->assertNull($contact->address2);
    }

    private function createContact(): Contact
    {
        return new Contact(
            id: 'c-1',
            firstName: 'Jane',
            lastName: 'Doe',
            email: 'jane@example.com',
            phone: '+1 555 0100',
            organization: 'Acme',
            address1: '1 Main St',
            city: 'Springfield',
            state: 'IL',
            postalCode: '62701',
            country: 'US',
            address2: 'Apt 2',
            fax: '+1 555 0101',
            isDefault: true,
        );
    }
}

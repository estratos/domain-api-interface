<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Tests\Request;

use Estratos\DomainApiInterface\Exception\RequestValidationException;
use Estratos\DomainApiInterface\Request\UpdateContactRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @small
 */
#[CoversClass(UpdateContactRequest::class)]
final class UpdateContactRequestTest extends TestCase
{
    public function testAcceptsValidInput(): void
    {
        $request = $this->createRequest();

        $this->assertSame('contact-1', $request->contactId);
        $this->assertSame('jane@example.com', $request->email);
    }

    public function testRejectsEmptyContactId(): void
    {
        $this->expectException(RequestValidationException::class);
        $this->expectExceptionMessage('Contact ID cannot be empty');

        $this->createRequest(contactId: '');
    }

    public function testRejectsInvalidEmail(): void
    {
        $this->expectException(RequestValidationException::class);
        $this->expectExceptionMessage('Invalid email format');

        $this->createRequest(email: 'not-an-email');
    }

    public function testRejectsEmptyPostalCode(): void
    {
        $this->expectException(RequestValidationException::class);
        $this->expectExceptionMessage('Postal code cannot be empty');

        $this->createRequest(postalCode: '');
    }

    private function createRequest(
        string $contactId = 'contact-1',
        string $email = 'jane@example.com',
        string $postalCode = '62701',
    ): UpdateContactRequest {
        return new UpdateContactRequest(
            contactId: $contactId,
            firstName: 'Jane',
            lastName: 'Doe',
            email: $email,
            phone: '+1 555 0100',
            organization: 'Acme',
            address1: '1 Main St',
            city: 'Springfield',
            state: 'IL',
            postalCode: $postalCode,
            country: 'US',
        );
    }
}

<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Tests\Request;

use Estratos\DomainApiInterface\Exception\RequestValidationException;
use Estratos\DomainApiInterface\Request\AddContactRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @small
 */
#[CoversClass(AddContactRequest::class)]
final class AddContactRequestTest extends TestCase
{
    public function testAcceptsValidInputWithDefaults(): void
    {
        $request = $this->createRequest();

        $this->assertSame('Jane', $request->firstName);
        $this->assertSame('jane@example.com', $request->email);
        $this->assertNull($request->address2);
        $this->assertFalse($request->isDefault);
    }

    public function testRejectsInvalidEmail(): void
    {
        $this->expectException(RequestValidationException::class);
        $this->expectExceptionMessage('Invalid email format');

        $this->createRequest(email: 'not-an-email');
    }

    public function testRejectsEmptyFirstName(): void
    {
        $this->expectException(RequestValidationException::class);
        $this->expectExceptionMessage('First name cannot be empty');

        $this->createRequest(firstName: '');
    }

    public function testRejectsEmptyCountry(): void
    {
        $this->expectException(RequestValidationException::class);
        $this->expectExceptionMessage('Country cannot be empty');

        $this->createRequest(country: '');
    }

    private function createRequest(
        string $firstName = 'Jane',
        string $email = 'jane@example.com',
        string $country = 'US',
    ): AddContactRequest {
        return new AddContactRequest(
            firstName: $firstName,
            lastName: 'Doe',
            email: $email,
            phone: '+1 555 0100',
            organization: 'Acme',
            address1: '1 Main St',
            city: 'Springfield',
            state: 'IL',
            postalCode: '62701',
            country: $country,
        );
    }
}

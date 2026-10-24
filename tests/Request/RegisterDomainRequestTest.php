<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Tests\Request;

use Estratos\DomainApiInterface\Exception\RequestValidationException;
use Estratos\DomainApiInterface\Request\RegisterDomainRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @small
 */
#[CoversClass(RegisterDomainRequest::class)]
final class RegisterDomainRequestTest extends TestCase
{
    public function testAcceptsValidInput(): void
    {
        $request = new RegisterDomainRequest(
            domain: 'example.com',
            years: 2,
            contactId: 'contact-1',
            private: true,
            autoRenew: true,
            nameserver1: 'ns1.example.com',
            nameserver2: 'ns2.example.com',
        );

        $this->assertSame('example.com', $request->domain);
        $this->assertSame(2, $request->years);
        $this->assertSame('contact-1', $request->contactId);
        $this->assertTrue($request->private);
        $this->assertTrue($request->autoRenew);
        $this->assertSame('ns1.example.com', $request->nameserver1);
        $this->assertSame('ns2.example.com', $request->nameserver2);
        $this->assertNull($request->nameserver3);
    }

    /**
     * @return array<string, array{int}>
     */
    public static function invalidTerms(): array
    {
        return [
            'zero' => [0],
            'too many years' => [11],
            'negative' => [-1],
        ];
    }

    #[DataProvider('invalidTerms')]
    public function testRejectsInvalidTerm(int $years): void
    {
        $this->expectException(RequestValidationException::class);
        $this->expectExceptionMessage('Years must be between 1 and 10');

        new RegisterDomainRequest('example.com', $years, 'contact-1');
    }

    public function testRejectsEmptyDomain(): void
    {
        $this->expectException(RequestValidationException::class);
        $this->expectExceptionMessage('Domain cannot be empty');

        new RegisterDomainRequest('', 1, 'contact-1');
    }

    public function testRejectsEmptyContactId(): void
    {
        $this->expectException(RequestValidationException::class);
        $this->expectExceptionMessage('Contact ID cannot be empty');

        new RegisterDomainRequest('example.com', 1, '');
    }
}

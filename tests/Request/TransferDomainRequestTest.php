<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Tests\Request;

use Estratos\DomainApiInterface\Exception\RequestValidationException;
use Estratos\DomainApiInterface\Request\TransferDomainRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @small
 */
#[CoversClass(TransferDomainRequest::class)]
final class TransferDomainRequestTest extends TestCase
{
    public function testAcceptsValidInputWithDefaults(): void
    {
        $request = new TransferDomainRequest('example.com', 'auth-code');

        $this->assertSame('example.com', $request->domain);
        $this->assertSame('auth-code', $request->authorizationCode);
        $this->assertSame(1, $request->years);
        $this->assertFalse($request->private);
        $this->assertFalse($request->autoRenew);
    }

    public function testRejectsEmptyAuthorizationCode(): void
    {
        $this->expectException(RequestValidationException::class);
        $this->expectExceptionMessage('Authorization code cannot be empty');

        new TransferDomainRequest('example.com', '');
    }

    public function testRejectsEmptyDomain(): void
    {
        $this->expectException(RequestValidationException::class);
        $this->expectExceptionMessage('Domain cannot be empty');

        new TransferDomainRequest('', 'auth-code');
    }

    public function testRejectsInvalidTerm(): void
    {
        $this->expectException(RequestValidationException::class);
        $this->expectExceptionMessage('Years must be between 1 and 10');

        new TransferDomainRequest('example.com', 'auth-code', 11);
    }
}

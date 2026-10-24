<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Tests\Request;

use Estratos\DomainApiInterface\Exception\RequestValidationException;
use Estratos\DomainApiInterface\Request\RenewDomainRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @small
 */
#[CoversClass(RenewDomainRequest::class)]
final class RenewDomainRequestTest extends TestCase
{
    public function testAcceptsValidInput(): void
    {
        $request = new RenewDomainRequest('example.com', 3);

        $this->assertSame('example.com', $request->domain);
        $this->assertSame(3, $request->years);
    }

    public function testRejectsInvalidTerm(): void
    {
        $this->expectException(RequestValidationException::class);
        $this->expectExceptionMessage('Years must be between 1 and 10');

        new RenewDomainRequest('example.com', 0);
    }

    public function testRejectsEmptyDomain(): void
    {
        $this->expectException(RequestValidationException::class);
        $this->expectExceptionMessage('Domain cannot be empty');

        new RenewDomainRequest('', 1);
    }
}

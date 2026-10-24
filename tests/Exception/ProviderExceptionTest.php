<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Tests\Exception;

use Estratos\DomainApiInterface\Exception\DomainNotFoundException;
use Estratos\DomainApiInterface\Exception\ProviderException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @small
 */
#[CoversClass(ProviderException::class)]
#[CoversClass(DomainNotFoundException::class)]
final class ProviderExceptionTest extends TestCase
{
    public function testIsARuntimeException(): void
    {
        $exception = new ProviderException('registrar unavailable');

        $this->assertInstanceOf(\RuntimeException::class, $exception);
        $this->assertSame('registrar unavailable', $exception->getMessage());
    }

    public function testDomainNotFoundIsAProviderException(): void
    {
        $exception = new DomainNotFoundException('unknown domain');

        $this->assertInstanceOf(ProviderException::class, $exception);
        $this->assertInstanceOf(\RuntimeException::class, $exception);
    }
}

<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Tests\Exception;

use Estratos\DomainApiInterface\Exception\RequestValidationException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @small
 */
#[CoversClass(RequestValidationException::class)]
final class RequestValidationExceptionTest extends TestCase
{
    public function testIsAnInvalidArgumentException(): void
    {
        $exception = new RequestValidationException('invalid input');

        $this->assertInstanceOf(\InvalidArgumentException::class, $exception);
        $this->assertSame('invalid input', $exception->getMessage());
    }
}

<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Tests\DTO;

use Estratos\DomainApiInterface\DTO\RegistrationResult;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @small
 */
#[CoversClass(RegistrationResult::class)]
final class RegistrationResultTest extends TestCase
{
    public function testSuccessFactoryFillsOrderAndDates(): void
    {
        $registeredAt = new \DateTimeImmutable('-1 minute');
        $expiresAt = new \DateTimeImmutable('+1 year');

        $result = RegistrationResult::success('example.com', 'order-1', $registeredAt, $expiresAt, 'tx-1');

        $this->assertTrue($result->isSuccess());
        $this->assertFalse($result->isFailure());
        $this->assertSame('order-1', $result->orderId);
        $this->assertSame($registeredAt, $result->registrationDate);
        $this->assertSame($expiresAt, $result->expirationDate);
        $this->assertSame('tx-1', $result->transactionId);
        $this->assertNull($result->errorMessage);
    }

    public function testFailureFactoryOnlyRequiresDomainAndMessage(): void
    {
        $result = RegistrationResult::failure('example.com', 'registrar rejected the request');

        $this->assertFalse($result->isSuccess());
        $this->assertTrue($result->isFailure());
        $this->assertNull($result->orderId);
        $this->assertNull($result->registrationDate);
        $this->assertNull($result->expirationDate);
        $this->assertSame('registrar rejected the request', $result->errorMessage);
    }
}

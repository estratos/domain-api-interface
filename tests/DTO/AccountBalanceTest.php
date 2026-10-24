<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Tests\DTO;

use Estratos\DomainApiInterface\DTO\AccountBalance;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @small
 */
#[CoversClass(AccountBalance::class)]
final class AccountBalanceTest extends TestCase
{
    public function testReportsPositiveBalance(): void
    {
        $balance = new AccountBalance(100.0, 'USD', 80.0, 20.0);

        $this->assertTrue($balance->isPositive());
        $this->assertFalse($balance->isNegative());
    }

    public function testReportsNegativeBalance(): void
    {
        $balance = new AccountBalance(-5.0, 'USD', 0.0, 0.0);

        $this->assertFalse($balance->isPositive());
        $this->assertTrue($balance->isNegative());
    }

    public function testChecksAvailableFunds(): void
    {
        $balance = new AccountBalance(100.0, 'USD', 80.0, 20.0);

        $this->assertTrue($balance->hasSufficientFunds(80.0));
        $this->assertTrue($balance->hasSufficientFunds(79.99));
        $this->assertFalse($balance->hasSufficientFunds(80.01));
    }
}

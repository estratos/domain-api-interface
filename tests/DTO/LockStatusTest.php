<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Tests\DTO;

use Estratos\DomainApiInterface\DTO\LockStatus;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @small
 */
#[CoversClass(LockStatus::class)]
final class LockStatusTest extends TestCase
{
    public function testReportsLockedDomain(): void
    {
        $status = new LockStatus('example.com', true);

        $this->assertTrue($status->isLocked());
        $this->assertFalse($status->isUnlocked());
    }

    public function testReportsUnlockedDomain(): void
    {
        $status = new LockStatus('example.com', false, 'unlocked', 'transfer allowed');

        $this->assertFalse($status->isLocked());
        $this->assertTrue($status->isUnlocked());
        $this->assertSame('unlocked', $status->status);
        $this->assertSame('transfer allowed', $status->message);
    }
}

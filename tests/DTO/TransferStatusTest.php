<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Tests\DTO;

use Estratos\DomainApiInterface\DTO\TransferStatus;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @small
 */
#[CoversClass(TransferStatus::class)]
final class TransferStatusTest extends TestCase
{
    public function testMatchesCanonicalStatuses(): void
    {
        $this->assertTrue($this->createStatus(TransferStatus::STATUS_PENDING)->isPending());
        $this->assertTrue($this->createStatus(TransferStatus::STATUS_COMPLETED)->isCompleted());
        $this->assertTrue($this->createStatus(TransferStatus::STATUS_FAILED)->isFailed());
        $this->assertTrue($this->createStatus(TransferStatus::STATUS_CANCELLED)->isCancelled());
    }

    public function testNormalizesCaseAndWhitespace(): void
    {
        $transfer = $this->createStatus('  COMPLETED ');

        $this->assertTrue($transfer->isCompleted());
        $this->assertFalse($transfer->isPending());
        $this->assertFalse($transfer->isFailed());
        $this->assertFalse($transfer->isCancelled());
    }

    private function createStatus(string $status): TransferStatus
    {
        return new TransferStatus('example.com', $status, new \DateTimeImmutable());
    }
}

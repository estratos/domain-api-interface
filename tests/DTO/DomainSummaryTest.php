<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Tests\DTO;

use Estratos\DomainApiInterface\DTO\DomainSummary;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @small
 */
#[CoversClass(DomainSummary::class)]
final class DomainSummaryTest extends TestCase
{
    public function testDetectsActiveStatusCaseInsensitively(): void
    {
        $this->assertTrue($this->createSummary(status: 'Active')->isActive());
        $this->assertFalse($this->createSummary(status: 'expired')->isActive());
    }

    public function testDetectsExpiredDomains(): void
    {
        $this->assertTrue($this->createSummary(expiresAt: new \DateTimeImmutable('-1 day'))->isExpired());
        $this->assertFalse($this->createSummary()->isExpired());
    }

    private function createSummary(
        string $status = 'active',
        ?\DateTimeImmutable $expiresAt = null,
    ): DomainSummary {
        return new DomainSummary(
            domain: 'example.com',
            status: $status,
            createdAt: new \DateTimeImmutable('-1 year'),
            expiresAt: $expiresAt ?? new \DateTimeImmutable('+1 year'),
            isLocked: false,
            isPrivacyEnabled: false,
        );
    }
}

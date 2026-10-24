<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Tests\DTO;

use Estratos\DomainApiInterface\DTO\DomainInfo;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @small
 */
#[CoversClass(DomainInfo::class)]
final class DomainInfoTest extends TestCase
{
    public function testDetectsActiveStatusCaseInsensitively(): void
    {
        $this->assertTrue($this->createInfo(status: 'ACTIVE')->isActive());
        $this->assertTrue($this->createInfo(status: ' active ')->isActive());
        $this->assertFalse($this->createInfo(status: 'expired')->isActive());
    }

    public function testDetectsExpiredDomains(): void
    {
        $info = $this->createInfo(expiresAt: new \DateTimeImmutable('-10 days'));

        $this->assertTrue($info->isExpired());
        $this->assertLessThan(0, $info->daysUntilExpiration());
    }

    public function testCountsDaysUntilExpirationForFutureDomains(): void
    {
        $info = $this->createInfo(expiresAt: new \DateTimeImmutable('+30 days'));

        $this->assertFalse($info->isExpired());
        $this->assertGreaterThan(0, $info->daysUntilExpiration());
    }

    public function testReportsNameServerAndFlagState(): void
    {
        $info = $this->createInfo(nameServers: ['ns1.example.com', 'ns2.example.com']);

        $this->assertTrue($info->hasCustomNameServers());
        $this->assertFalse($this->createInfo()->hasCustomNameServers());
        $this->assertTrue($info->isLocked());
        $this->assertFalse($info->isPrivacyEnabled());
    }

    /**
     * @param string[] $nameServers
     */
    private function createInfo(
        string $status = 'active',
        ?\DateTimeImmutable $expiresAt = null,
        array $nameServers = [],
    ): DomainInfo {
        $createdAt = new \DateTimeImmutable('-1 year');

        return new DomainInfo(
            domain: 'example.com',
            status: $status,
            createdAt: $createdAt,
            expiresAt: $expiresAt ?? new \DateTimeImmutable('+1 year'),
            updatedAt: $createdAt,
            isLocked: true,
            isPrivacyEnabled: false,
            isAutoRenewEnabled: true,
            nameServers: $nameServers,
        );
    }
}

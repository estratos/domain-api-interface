<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Tests\DTO;

use Estratos\DomainApiInterface\DTO\DomainAvailability;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @small
 */
#[CoversClass(DomainAvailability::class)]
final class DomainAvailabilityTest extends TestCase
{
    public function testReportsAnAvailableDomain(): void
    {
        $availability = new DomainAvailability(domain: 'example.com', available: true);

        $this->assertTrue($availability->isAvailable());
        $this->assertFalse($availability->isUnavailable());
        $this->assertNull($availability->reason);
    }

    public function testReportsAnUnavailableDomainWithReason(): void
    {
        $availability = new DomainAvailability(
            domain: 'example.com',
            available: false,
            reason: 'registered',
            suggestedAlternative: 'example.net',
        );

        $this->assertFalse($availability->isAvailable());
        $this->assertTrue($availability->isUnavailable());
        $this->assertSame('registered', $availability->reason);
        $this->assertSame('example.net', $availability->suggestedAlternative);
    }
}

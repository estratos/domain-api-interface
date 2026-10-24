<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Tests\DTO;

use Estratos\DomainApiInterface\DTO\PrivacyStatus;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @small
 */
#[CoversClass(PrivacyStatus::class)]
final class PrivacyStatusTest extends TestCase
{
    public function testReportsEnabledPrivacy(): void
    {
        $status = new PrivacyStatus('example.com', true);

        $this->assertTrue($status->isEnabled());
        $this->assertFalse($status->isDisabled());
    }

    public function testReportsDisabledPrivacy(): void
    {
        $status = new PrivacyStatus('example.com', false, 'disabled', 'not supported for this TLD');

        $this->assertFalse($status->isEnabled());
        $this->assertTrue($status->isDisabled());
        $this->assertSame('disabled', $status->status);
        $this->assertSame('not supported for this TLD', $status->message);
    }
}

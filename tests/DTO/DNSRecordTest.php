<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Tests\DTO;

use Estratos\DomainApiInterface\DTO\DNSRecord;
use Estratos\DomainApiInterface\Enum\RecordType;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @small
 */
#[CoversClass(DNSRecord::class)]
final class DNSRecordTest extends TestCase
{
    public function testIdentifiesRecordTypes(): void
    {
        $record = new DNSRecord('1', '@', RecordType::CNAME, 'example.com', 300);

        $this->assertTrue($record->isCNAME());
        $this->assertFalse($record->isA());
        $this->assertFalse($record->isAAAA());
        $this->assertFalse($record->isMX());
    }

    public function testMxRecordsExposePriority(): void
    {
        $mx = new DNSRecord('1', '@', RecordType::MX, 'mail.example.com', 300, priority: 10);
        $txt = new DNSRecord('2', '@', RecordType::TXT, 'v=spf1 -all', 300, priority: 10);

        $this->assertTrue($mx->hasPriority());
        $this->assertFalse($txt->hasPriority());
        $this->assertSame(10, $mx->priority);
    }
}

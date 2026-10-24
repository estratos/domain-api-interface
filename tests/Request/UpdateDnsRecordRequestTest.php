<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Tests\Request;

use Estratos\DomainApiInterface\Enum\RecordType;
use Estratos\DomainApiInterface\Exception\RequestValidationException;
use Estratos\DomainApiInterface\Request\UpdateDnsRecordRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @small
 */
#[CoversClass(UpdateDnsRecordRequest::class)]
final class UpdateDnsRecordRequestTest extends TestCase
{
    public function testAcceptsValidInput(): void
    {
        $request = new UpdateDnsRecordRequest('example.com', 'rec-1', '@', RecordType::TXT, 'v=spf1 -all');

        $this->assertSame('rec-1', $request->recordId);
        $this->assertSame(RecordType::TXT, $request->type);
        $this->assertSame(3600, $request->ttl);
    }

    public function testRejectsEmptyRecordId(): void
    {
        $this->expectException(RequestValidationException::class);
        $this->expectExceptionMessage('Record ID cannot be empty');

        new UpdateDnsRecordRequest('example.com', '', '@', RecordType::A, '192.0.2.1');
    }

    public function testRequiresPriorityForMxRecords(): void
    {
        $this->expectException(RequestValidationException::class);
        $this->expectExceptionMessage('Priority is required for MX records');

        new UpdateDnsRecordRequest('example.com', 'rec-1', '@', RecordType::MX, 'mail.example.com');
    }

    public function testRejectsOutOfRangeTtl(): void
    {
        $this->expectException(RequestValidationException::class);
        $this->expectExceptionMessage('TTL must be between 60 and 86400 seconds');

        new UpdateDnsRecordRequest('example.com', 'rec-1', '@', RecordType::A, '192.0.2.1', 59);
    }
}

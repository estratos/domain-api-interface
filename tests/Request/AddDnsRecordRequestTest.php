<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Tests\Request;

use Estratos\DomainApiInterface\Enum\RecordType;
use Estratos\DomainApiInterface\Exception\RequestValidationException;
use Estratos\DomainApiInterface\Request\AddDnsRecordRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @small
 */
#[CoversClass(AddDnsRecordRequest::class)]
final class AddDnsRecordRequestTest extends TestCase
{
    public function testAcceptsValidARecord(): void
    {
        $request = new AddDnsRecordRequest('example.com', '@', RecordType::A, '192.0.2.1');

        $this->assertSame(RecordType::A, $request->type);
        $this->assertSame(3600, $request->ttl);
        $this->assertNull($request->priority);
    }

    public function testAcceptsValidSrvRecord(): void
    {
        $request = new AddDnsRecordRequest(
            domain: 'example.com',
            host: '_sip._tcp',
            type: RecordType::SRV,
            value: 'sip.example.com',
            ttl: 300,
            priority: 10,
            port: 5060,
            weight: 5,
        );

        $this->assertSame(5060, $request->port);
        $this->assertSame(5, $request->weight);
    }

    /**
     * @return array<string, array{int}>
     */
    public static function invalidTtls(): array
    {
        return [
            'below minimum' => [59],
            'above maximum' => [86401],
        ];
    }

    #[DataProvider('invalidTtls')]
    public function testRejectsOutOfRangeTtl(int $ttl): void
    {
        $this->expectException(RequestValidationException::class);
        $this->expectExceptionMessage('TTL must be between 60 and 86400 seconds');

        new AddDnsRecordRequest('example.com', '@', RecordType::A, '192.0.2.1', $ttl);
    }

    public function testRequiresPriorityForMxRecords(): void
    {
        $this->expectException(RequestValidationException::class);
        $this->expectExceptionMessage('Priority is required for MX records');

        new AddDnsRecordRequest('example.com', '@', RecordType::MX, 'mail.example.com');
    }

    public function testRequiresPortAndWeightForSrvRecords(): void
    {
        $this->expectException(RequestValidationException::class);
        $this->expectExceptionMessage('Port and weight are required for SRV records');

        new AddDnsRecordRequest('example.com', '_sip._tcp', RecordType::SRV, 'sip.example.com', priority: 10);
    }

    public function testRejectsEmptyHost(): void
    {
        $this->expectException(RequestValidationException::class);
        $this->expectExceptionMessage('Host cannot be empty');

        new AddDnsRecordRequest('example.com', '', RecordType::A, '192.0.2.1');
    }

    public function testRejectsEmptyValue(): void
    {
        $this->expectException(RequestValidationException::class);
        $this->expectExceptionMessage('Value cannot be empty');

        new AddDnsRecordRequest('example.com', '@', RecordType::A, '');
    }
}

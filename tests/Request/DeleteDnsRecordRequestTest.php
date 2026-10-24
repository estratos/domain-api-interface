<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Tests\Request;

use Estratos\DomainApiInterface\Exception\RequestValidationException;
use Estratos\DomainApiInterface\Request\DeleteDnsRecordRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @small
 */
#[CoversClass(DeleteDnsRecordRequest::class)]
final class DeleteDnsRecordRequestTest extends TestCase
{
    public function testAcceptsValidInput(): void
    {
        $request = new DeleteDnsRecordRequest('example.com', 'rec-1');

        $this->assertSame('example.com', $request->domain);
        $this->assertSame('rec-1', $request->recordId);
    }

    public function testRejectsEmptyDomain(): void
    {
        $this->expectException(RequestValidationException::class);
        $this->expectExceptionMessage('Domain cannot be empty');

        new DeleteDnsRecordRequest('', 'rec-1');
    }

    public function testRejectsEmptyRecordId(): void
    {
        $this->expectException(RequestValidationException::class);
        $this->expectExceptionMessage('Record ID cannot be empty');

        new DeleteDnsRecordRequest('example.com', '');
    }
}

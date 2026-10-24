<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Tests\Enum;

use Estratos\DomainApiInterface\Enum\RecordType;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @small
 */
#[CoversClass(RecordType::class)]
final class RecordTypeTest extends TestCase
{
    public function testExposesAllSupportedRecordTypes(): void
    {
        $this->assertCount(14, RecordType::cases());
    }

    public function testValuesMatchCaseNames(): void
    {
        foreach (RecordType::cases() as $case) {
            $this->assertSame($case->name, $case->value);
        }
    }

    public function testClassifiesNormalRecordTypes(): void
    {
        $this->assertTrue(RecordType::A->isNormal());
        $this->assertTrue(RecordType::AAAA->isNormal());
        $this->assertTrue(RecordType::CNAME->isNormal());
        $this->assertTrue(RecordType::MX->isNormal());
        $this->assertTrue(RecordType::TXT->isNormal());
        $this->assertTrue(RecordType::NS->isNormal());

        $this->assertFalse(RecordType::SRV->isNormal());
        $this->assertTrue(RecordType::SRV->isAdvanced());
        $this->assertFalse(RecordType::A->isAdvanced());
    }

    public function testRequiresPriorityForMxAndSrv(): void
    {
        $this->assertTrue(RecordType::MX->requiresPriority());
        $this->assertTrue(RecordType::SRV->requiresPriority());
        $this->assertFalse(RecordType::A->requiresPriority());
        $this->assertFalse(RecordType::TXT->requiresPriority());
    }

    public function testRequiresPortAndWeightOnlyForSrv(): void
    {
        $this->assertTrue(RecordType::SRV->requiresPort());
        $this->assertTrue(RecordType::SRV->requiresWeight());
        $this->assertFalse(RecordType::MX->requiresPort());
        $this->assertFalse(RecordType::MX->requiresWeight());
    }
}

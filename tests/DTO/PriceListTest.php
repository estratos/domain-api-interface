<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Tests\DTO;

use Estratos\DomainApiInterface\DTO\PriceList;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @small
 */
#[CoversClass(PriceList::class)]
final class PriceListTest extends TestCase
{
    public function testReturnsPriceForKnownTld(): void
    {
        $list = new PriceList(['.com' => 10.5, '.net' => 12.0], 'USD');

        $this->assertSame(10.5, $list->getPrice('.com'));
        $this->assertNull($list->getPrice('.io'));
    }

    public function testFiltersPricesByCategory(): void
    {
        $list = new PriceList([
            '.com' => 10.5,
            '.com.br' => 20.0,
            '.net' => 12.0,
        ], 'USD');

        $this->assertSame(
            ['.com' => 10.5, '.com.br' => 20.0],
            $list->getPricesByCategory('.com'),
        );
    }
}

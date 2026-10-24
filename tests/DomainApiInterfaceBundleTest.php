<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Tests;

use Estratos\DomainApiInterface\DomainApiInterfaceBundle;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

/**
 * @internal
 * @small
 */
#[CoversClass(DomainApiInterfaceBundle::class)]
final class DomainApiInterfaceBundleTest extends TestCase
{
    public function testExposesThePackageRootAsBundlePath(): void
    {
        $bundle = new DomainApiInterfaceBundle();

        $this->assertInstanceOf(AbstractBundle::class, $bundle);
        $this->assertSame(\dirname(__DIR__), $bundle->getPath());
    }
}

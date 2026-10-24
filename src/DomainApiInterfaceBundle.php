<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface;

use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

/**
 * Registers the bundle in a Symfony application.
 *
 * The bundle ships no services or configuration; it only exposes the
 * contracts, DTOs, request objects and enums of this package.
 */
final class DomainApiInterfaceBundle extends AbstractBundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}

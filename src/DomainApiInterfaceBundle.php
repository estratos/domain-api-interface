<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface;

use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

final class DomainApiInterfaceBundle extends AbstractBundle
{
    private const EXTENSION_ALIAS = 'domain_api_interface';

    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}

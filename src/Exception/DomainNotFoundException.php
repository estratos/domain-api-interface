<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Exception;

/**
 * Thrown when a domain is not known to the registrar.
 */
class DomainNotFoundException extends ProviderException
{
}

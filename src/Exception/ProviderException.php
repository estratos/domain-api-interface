<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Exception;

/**
 * Base exception for failures reported by a registrar provider implementation.
 *
 * Provider adapters should translate their transport/SDK errors into this
 * exception (or a subclass) so callers do not need to know which registrar is
 * in use.
 */
class ProviderException extends \RuntimeException
{
}

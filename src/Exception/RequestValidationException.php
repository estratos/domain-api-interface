<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Exception;

use InvalidArgumentException;

/**
 * Thrown when a request object receives invalid input.
 *
 * Extends {@see InvalidArgumentException} so existing catch blocks keep
 * working while allowing callers to catch validation errors specifically.
 */
class RequestValidationException extends \InvalidArgumentException
{
}

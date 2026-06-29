<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\DTO;

use DateTimeImmutable;

final readonly class RegistrationResult
{
    public function __construct(
        public bool $success,
        public string $domain,
        public string $orderId,
        public DateTimeImmutable $registrationDate,
        public DateTimeImmutable $expirationDate,
        public ?string $transactionId = null,
        public ?string $errorMessage = null,
    ) {
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function isFailure(): bool
    {
        return !$this->success;
    }
}

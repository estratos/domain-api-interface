<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\DTO;

/**
 * Outcome of a registration, renewal or transfer operation.
 *
 * On failure only `domain` and `errorMessage` are guaranteed to be meaningful;
 * the order and date fields are nullable for that reason. Use the
 * {@see self::success()} and {@see self::failure()} factories to build results
 * without filling unused values.
 */
final readonly class RegistrationResult
{
    public function __construct(
        public bool $success,
        public string $domain,
        public ?string $orderId = null,
        public ?\DateTimeImmutable $registrationDate = null,
        public ?\DateTimeImmutable $expirationDate = null,
        public ?string $transactionId = null,
        public ?string $errorMessage = null,
    ) {
    }

    public static function success(
        string $domain,
        string $orderId,
        \DateTimeImmutable $registrationDate,
        \DateTimeImmutable $expirationDate,
        ?string $transactionId = null,
    ): self {
        return new self(
            success: true,
            domain: $domain,
            orderId: $orderId,
            registrationDate: $registrationDate,
            expirationDate: $expirationDate,
            transactionId: $transactionId,
        );
    }

    public static function failure(
        string $domain,
        string $errorMessage,
        ?string $transactionId = null,
    ): self {
        return new self(
            success: false,
            domain: $domain,
            transactionId: $transactionId,
            errorMessage: $errorMessage,
        );
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

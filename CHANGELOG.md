# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [1.1.0] - 2026-10-24

### Added

- `ProviderException`, `DomainNotFoundException` and `RequestValidationException`
  to define a registrar-independent error contract. Every contract method now
  documents `@throws ProviderException`.
- `RegistrationResult::success()` and `RegistrationResult::failure()` factories.
- Canonical status constants: `TransferStatus::STATUS_*` and
  `DomainInfo::STATUS_ACTIVE` / `DomainSummary::STATUS_ACTIVE`.
- PHPUnit suite under `tests/` (71 tests, 201 assertions) with the
  `#[CoversClass]` metadata required by `phpunit.xml.dist`.
- Array shape annotations (`string[]`, `array<string, float>`) so static
  analysis can run at `--level=max`.

### Changed

- **BC:** `RegistrationResult::$orderId`, `$registrationDate` and
  `$expirationDate` are now nullable and optional, so failed results no longer
  require placeholder values.
- `TransferStatus`, `DomainInfo` and `DomainSummary` status checks ignore case
  and surrounding whitespace.
- Runtime dependencies narrowed from `symfony/framework-bundle` to
  `symfony/config`, `symfony/dependency-injection` and `symfony/http-kernel`.
- PHPStan upgraded to `^2.2`; the codebase is clean at `--level=max`.
- PHP-CS-Fixer configuration fixed (unknown `types_namespaces` rule removed,
  `blank_line_after_opening_tag` enabled) and the codebase formatted.
- `phpunit.xml.dist` no longer uses the `<coverage><include>` element (removed
  in PHPUnit 10) and no longer requests coverage reports without a driver.
- `README.md` rewritten with the full API reference, working examples and
  correctly closed code blocks.

### Fixed

- `DomainInfo::daysUntilExpiration()` now returns a negative value for expired
  domains (`DateInterval::$days` is absolute).
- `CHANGELOG.md` still contained generation artifacts (`### 31. CHANGELOG.md`
  and an unclosed code fence).
- `LICENSE` shipped GPL-3.0 text while the project metadata declared MIT; both
  are now MIT.
- `.gitignore` targeted a Symfony 2/3 layout and missed the PHPUnit, PHPStan and
  PHP-CS-Fixer cache directories.

### Removed

- Unused `EXTENSION_ALIAS` constant in `DomainApiInterfaceBundle`.

## [1.0.0] - 2026-06-29

### Added

- `DomainProviderInterface` with 8 methods.
- `DNSProviderInterface` with 4 methods.
- `ContactProviderInterface` with 4 methods.
- `AccountProviderInterface` with 2 methods.
- `PrivacyProviderInterface` with 2 methods.
- `LockProviderInterface` with 2 methods.
- `NameServerProviderInterface` with 1 method.
- All DTOs as `final readonly` immutable classes.
- All request objects with constructor validation.
- `RecordType` enum.
- PHPDoc on every contract method.
- PHPStan and PHP-CS-Fixer configuration, PSR-12 coding standards.
- PHPUnit configuration for a `tests/` suite.

[Unreleased]: https://github.com/estratos/domain-api-interface/compare/1.1.0...main
[1.1.0]: https://github.com/estratos/domain-api-interface/compare/1.0.0...1.1.0
[1.0.0]: https://github.com/estratos/domain-api-interface/releases/tag/1.0.0

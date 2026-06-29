<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Enum;

enum RecordType: string
{
    case A = 'A';
    case AAAA = 'AAAA';
    case CNAME = 'CNAME';
    case MX = 'MX';
    case TXT = 'TXT';
    case NS = 'NS';
    case SRV = 'SRV';
    case CAA = 'CAA';
    case SOA = 'SOA';
    case PTR = 'PTR';
    case SPF = 'SPF';
    case DS = 'DS';
    case DNAME = 'DNAME';
    case LOC = 'LOC';

    public function isNormal(): bool
    {
        return in_array($this, [self::A, self::AAAA, self::CNAME, self::MX, self::TXT, self::NS]);
    }

    public function isAdvanced(): bool
    {
        return !$this->isNormal();
    }

    public function requiresPriority(): bool
    {
        return in_array($this, [self::MX, self::SRV]);
    }

    public function requiresPort(): bool
    {
        return in_array($this, [self::SRV]);
    }

    public function requiresWeight(): bool
    {
        return in_array($this, [self::SRV]);
    }
}

<?php

declare(strict_types=1);

namespace PhoneNumberCategotization\Core\Infrastructure;

use PhoneNumberCategotization\Core\Domain\Country;
use PhoneNumberCategotization\Core\Domain\CountryFinder;

class FixedCountryFinder implements CountryFinder
{
    public function findAll(): array
    {
        return [
            Country::create('Cameroon'  , '237', '/\(237\)\ ?[2368]\d{7,8}$/'),
            Country::create('Ethiopia', '251', '/\(251\)\ ?[1-59]\d{8}$/'),
            Country::create('Morocco', '212', '/\(212\)\ ?[5-9]\d{8}$/'),
            Country::create('Mozambique', '258', '/\(258\)\ ?[28]\d{7,8}$/'),
            Country::create('Uganda', '256', '/\(256\)\ ?\d{9}$/'),
        ];
    }
}

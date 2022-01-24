<?php

declare(strict_types=1);

namespace PhoneNumberCategotization\Core\Application;

/** @psalm-immutable */
class FetchCategorizedPhoneNumbers
{
    public function __construct(
        public ?string $countryCode = null,
        public ?string $state = null
    ) { }
}
